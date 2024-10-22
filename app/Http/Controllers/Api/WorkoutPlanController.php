<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Services\WorkoutPlanService;

class WorkoutPlanController extends Controller
{
    public function createWorkoutPlan(WorkoutPlanService $service)
    {
        $workoutPlanData = request()->get('workoutPlan', []);
        $customer = Customer::find(2); // tu jest na sztywno drugi ziomo

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

    public function getWorkoutPlan(WorkoutPlanService $service)
    {

        try {
            $data = $service->getWorkoutPlan();
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
