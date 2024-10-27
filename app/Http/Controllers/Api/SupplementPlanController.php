<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Services\SupplementPlanService;
use App\Http\Controllers\Controller;

class SupplementPlanController extends Controller
{
    public function createSupplementPlan(SupplementPlanService $service)
    {
        // Pobranie danych planu suplementacyjnego z requesta
        $supplementPlanData = request()->get('supplementPlan', []);
        $customer = Customer::find(14); // ustalony na sztywno, analogicznie

        try {
            // Tworzenie planu suplementacyjnego
            $data = $service->createSupplementPlan($supplementPlanData, $customer);
        } catch (\Exception $exception) {
            // Obsługa wyjątków i zwrócenie błędu
            return response()->json($exception->getMessage(), 400);
        }

        // Zwrócenie pozytywnej odpowiedzi z danymi nowo utworzonego planu
        return response()->json([
            'status' => 200,
            'message' => 'Plan suplementacyjny stworzony pomyślnie',
            'data' => $data->toArray()
        ]);
    }

    public function getSupplementPlan(SupplementPlanService $service)
    {
        try {
            // Pobranie planów suplementacyjnych
            $data = $service->getSupplementPlan();
        } catch (\Exception $exception) {
            // Obsługa wyjątków i zwrócenie błędu
            return response()->json($exception->getMessage(), 400);
        }

        // Zwrócenie pozytywnej odpowiedzi z danymi planów
        return response()->json([
            'status' => 200,
            'message' => 'Plany suplementacyjne pobrane pomyślnie',
            'data' => $data->toArray()
        ]);
    }
}
