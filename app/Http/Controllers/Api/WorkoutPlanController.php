<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Services\WorkoutPlanService;

class WorkoutPlanController extends Controller
{
    public function createWorkoutPlan(WorkoutPlanService $service)
    {
        $workoutPlanData = request()->get('workoutPlan', []);
        $customer = Customer::find(1);

        try {
            $data = $service->createWorkoutPlan($workoutPlanData, $customer);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Plan treningowy stworzony pomyślnie',
            'data' => $data->toArray()
        ]);
    }
}
