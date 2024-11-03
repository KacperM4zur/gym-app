<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Day;
use App\Models\ExercisePlanDay;
use App\Models\WorkoutPlan;
use App\Models\WorkoutPlanDay;
use Illuminate\Support\Collection;

class WorkoutPlanService
{
    public function createWorkoutPlan(array $workoutPlanData, ?Customer $customer): WorkoutPlan
    {
        $workoutPlan = WorkoutPlan::create(['name' => $workoutPlanData['workoutPlanName'], 'customer_id' => $customer->id]);
        $days = Day::whereIn('number', array_column($workoutPlanData['plan'], 'day_of_week'))->get();

        foreach ($workoutPlanData['plan'] as $plan) {
            $dayPlan = WorkoutPlanDay::create(['workout_plan_id' => $workoutPlan->id, 'day_id' => $days->firstWhere('id', '=', $plan['day_of_week'])->id]);

            $exercises = array_map(function ($exercise) use ($dayPlan) {
                $exercise['workout_plan_day_id'] = $dayPlan->id;
                return $exercise;
            }, $plan['exercises']);

            ExercisePlanDay::insert($exercises);
        }

        return $workoutPlan;
    }

    public function getWorkoutPlan(): Collection {
        return WorkoutPlan::with(['workoutDays.workoutExercises'])
            ->get()
            ->map(fn($workoutPlan) => [
                'name' => $workoutPlan->name,
                'plan' => $workoutPlan->workoutDays->map(fn($workoutDay) => [
                    'day' => $workoutDay->day->name,
                    'exercises' => $workoutDay->workoutExercises->map(fn($workoutDayExercise) => [
                        'name' => $workoutDayExercise->exercise->name,
                        'sets' => $workoutDayExercise->sets,
                        'reps' => $workoutDayExercise->reps,
                        'weight' => $workoutDayExercise->weight,
                        'break' => $workoutDayExercise->break
                    ])->toArray()
                ])->toArray()
            ]);
    }

    public function getWorkoutPlansForCustomer(Customer $customer): Collection
    {
        return WorkoutPlan::with(['workoutDays.workoutExercises']) // Eager loading dla dni i ćwiczeń
        ->where('customer_id', $customer->id)
            ->get()
            ->map(fn($workoutPlan) => [
                'id' => $workoutPlan->id,
                'name' => $workoutPlan->name,
                'plan' => $workoutPlan->workoutDays->map(fn($workoutDay) => [
                    'day' => $workoutDay->day->name,
                    'exercises' => $workoutDay->workoutExercises->map(fn($exercise) => [
                        'name' => $exercise->exercise->name,
                        'sets' => $exercise->sets,
                        'reps' => $exercise->reps,
                        'weight' => $exercise->weight,
                        'break' => $exercise->break
                    ])->toArray()
                ])->toArray()
            ]);
    }

    public function deleteWorkoutPlan(int $id, $user): bool
    {
        $workoutPlan = WorkoutPlan::where('id', $id)->where('customer_id', $user->id)->first();

        if (!$workoutPlan) {
            throw new \Exception('Plan nie znaleziony lub brak dostępu');
        }

        return $workoutPlan->delete();
    }

    public function activatePlan($id)
    {
        // Retrieve the selected workout plan by ID
        $plan = WorkoutPlan::findOrFail($id);

        // Deactivate all other workout plans for this user
        WorkoutPlan::where('customer_id', $plan->customer_id)
            ->where('id', '!=', $plan->id) // Exclude the selected plan from this update
            ->update(['is_active' => false]);

        // Activate the selected workout plan
        $plan->is_active = true;
        $plan->save();

        return $plan;
    }


}
