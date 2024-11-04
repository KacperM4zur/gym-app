<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Day;
use App\Models\SupplementPlan;
use App\Models\SupplementPlanDay;
use App\Models\SupplementDetail;
use Illuminate\Support\Collection;

class SupplementPlanService
{
    public function createSupplementPlan(array $supplementPlanData, ?Customer $customer): SupplementPlan
    {
        // Tworzenie głównego planu suplementacyjnego
        $supplementPlan = SupplementPlan::create([
            'name' => $supplementPlanData['plan_name'], // Zaktualizowane na 'plan_name'
            'customer_id' => $customer->id,
        ]);

        // Pobieranie dni na podstawie numerów z planu
        $days = Day::whereIn('number', array_column($supplementPlanData['plan'], 'day_of_week'))->get();

        foreach ($supplementPlanData['plan'] as $plan) {
            // Tworzenie dnia planu suplementacyjnego
            $dayPlan = SupplementPlanDay::create([
                'supplement_plan_id' => $supplementPlan->id,
                'day_id' => $days->firstWhere('number', '=', $plan['day_of_week'])->id
            ]);

            // Dodawanie szczegółów suplementacji dla danego dnia
            $supplements = array_map(function ($supplement) use ($dayPlan) {
                return [
                    'supplement_plan_day_id' => $dayPlan->id,
                    'supplement_id' => $supplement['supplement_id'],
                    'amount' => $supplement['amount'],
                    'unit' => $supplement['unit']
                ];
            }, $plan['supplements']);

            // Wstawianie suplementów jako szczegółów dnia
            SupplementDetail::insert($supplements);
        }

        return $supplementPlan;
    }

    public function getSupplementPlan(): Collection
    {
        return SupplementPlan::with(['supplementPlanDays.supplementDetails'])
            ->get()
            ->map(fn($supplementPlan) => [
                'name' => $supplementPlan->name,
                'plan' => $supplementPlan->supplementPlanDays->map(fn($day) => [
                    'day' => $day->day->name,
                    'supplements' => $day->supplementDetails->map(fn($detail) => [
                        'name' => $detail->supplement->name,
                        'amount' => $detail->amount,
                        'unit' => $detail->unit,
                    ])->toArray()
                ])->toArray()
            ]);
    }

    public function getSupplementPlansForCustomer(Customer $customer): Collection
    {
        return SupplementPlan::with(['supplementPlanDays.supplementDetails'])
            ->where('customer_id', $customer->id) // Tylko plany dla zalogowanego użytkownika
            ->get()
            ->map(fn($supplementPlan) => [
                'id' => $supplementPlan->id,
                'name' => $supplementPlan->name,
                'plan' => $supplementPlan->supplementPlanDays->map(fn($day) => [
                    'day' => $day->day->name,
                    'supplements' => $day->supplementDetails->map(fn($detail) => [
                        'name' => $detail->supplement->name,
                        'amount' => $detail->amount,
                        'unit' => $detail->unit,
                    ])->toArray()
                ])->toArray()
            ]);
    }

    public function deleteSupplementPlan(int $id, $user): bool
    {
        // Wyszukanie planu suplementacyjnego, który należy do zalogowanego użytkownika
        $supplementPlan = SupplementPlan::where('id', $id)->where('customer_id', $user->id)->first();

        if (!$supplementPlan) {
            throw new \Exception('Plan suplementacyjny nie znaleziony lub brak dostępu');
        }

        // Usunięcie planu suplementacyjnego
        return $supplementPlan->delete();
    }

    public function activatePlan($id)
    {
        // Retrieve the selected plan by ID
        $plan = SupplementPlan::findOrFail($id);

        // Deactivate all other plans for this user
        SupplementPlan::where('customer_id', $plan->customer_id)
            ->where('id', '!=', $plan->id) // Exclude the selected plan from this update
            ->update(['is_active' => false]);

        // Activate the selected plan
        $plan->is_active = true;
        $plan->save();

        return $plan;
    }

    public function getActiveSupplementPlanForCustomer($customer)
    {
        return SupplementPlan::where('customer_id', $customer->id)
            ->where('is_active', true)
            ->with('supplementPlanDays.supplementDetails.supplement') // Dodaje szczegóły dnia i suplementów
            ->first();
    }

    public function getActiveSupplementPlanByCustomer($customerId)
    {
        return SupplementPlan::where('customer_id', $customerId)
            ->where('is_active', 1)
            ->with('supplementPlanDays.supplementDetails.supplement')
            ->first();
    }

}
