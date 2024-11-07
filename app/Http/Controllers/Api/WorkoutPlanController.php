<?php
//
//namespace App\Http\Controllers\Api;
//
//use App\Models\Customer;
//use App\Services\WorkoutPlanService;
//
//class WorkoutPlanController extends Controller
//{
//    public function createWorkoutPlan(WorkoutPlanService $service)
//    {
//        $workoutPlanData = request()->get('workoutPlan', []);
//        $customer = Customer::find(14); // tu jest na sztywno drugi ziomo
//
//        try {
//            $data = $service->createWorkoutPlan($workoutPlanData, $customer);
//        } catch (\Exception $exception) {
//            return response()->json($exception->getMessage(), 400);
//        }
//        return response()->json([
//            'status' => 200,
//            'message' => 'Plan treningowy stworzony pomyślnie',
//            'data' => $data->toArray()
//        ]);
//    }
//
//    public function getWorkoutPlan(WorkoutPlanService $service)
//    {
//
//        try {
//            $data = $service->getWorkoutPlan();
//        } catch (\Exception $exception) {
//            return response()->json($exception->getMessage(), 400);
//        }
//        return response()->json([
//            'status' => 200,
//            'message' => 'Plan treningowy stworzony pomyślnie',
//            'data' => $data->toArray()
//        ]);
//    }
//}


namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Models\WorkoutPlan;
use App\Services\WorkoutPlanService;
use Illuminate\Support\Facades\Auth;

class WorkoutPlanController extends Controller
{
    protected WorkoutPlanService $workoutPlanService;

    public function __construct(WorkoutPlanService $workoutPlanService)
    {
        $this->workoutPlanService = $workoutPlanService;
    }

    public function createWorkoutPlan(WorkoutPlanService $service)
    {
        $workoutPlanData = request()->get('workoutPlan', []);

        // Pobieranie zalogowanego użytkownika z tokena
        $customer = Auth::user();

        if (!$customer) {
            return response()->json([
                'status' => 401,
                'message' => 'Nieautoryzowany użytkownik'
            ], 401);
        }

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
            'message' => 'Plan treningowy pobrany pomyślnie',
            'data' => $data->toArray()
        ]);
    }

    public function getUserWorkoutPlans(WorkoutPlanService $service)
    {
        try {
            // Pobranie zalogowanego użytkownika
            $customer = auth()->user();

            // Pobranie wszystkich planów treningowych dla użytkownika
            $plans = $service->getWorkoutPlansForCustomer($customer);

            return response()->json([
                'status' => 200,
                'message' => 'Plany treningowe pobrane pomyślnie',
                'data' => $plans->toArray()
            ]);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function deleteWorkoutPlan($id, WorkoutPlanService $service)
    {
        try {
            $user = Auth::user();

            $service->deleteWorkoutPlan($id, $user);

            return response()->json(['status' => 'Plan treningowy został usunięty pomyślnie'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function activatePlan($id)
    {
        try {
            $activatedPlan = $this->workoutPlanService->activatePlan($id);
            return response()->json(['status' => 200, 'message' => 'Plan activated successfully', 'data' => $activatedPlan]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'An error occurred while activating the plan']);
        }
    }

    public function getActiveWorkoutPlan()
    {
        $customer = auth()->user();

        $activePlan = $this->workoutPlanService->getActiveWorkoutPlan($customer->id);

        return response()->json([
            'status' => 200,
            'message' => 'Active workout plan retrieved successfully',
            'data' => $activePlan,
        ]);
    }

    public function getActiveWorkoutPlanForClient($customerId)
    {
        $activePlan = $this->workoutPlanService->getActiveWorkoutPlanByCustomer($customerId);

        if ($activePlan) {
            return response()->json(['status' => 200, 'data' => $activePlan]);
        } else {
            return response()->json(['status' => 404, 'message' => 'Active workout plan not found'], 404);
        }
    }

    public function getWorkoutPlansForClient(WorkoutPlanService $service, $customerId)
    {
        try {
            // Pobranie wszystkich planów treningowych dla danego klienta
            $plans = $service->getWorkoutPlansForSpecificCustomer($customerId);

            return response()->json([
                'status' => 200,
                'message' => 'Plany treningowe klienta pobrane pomyślnie',
                'data' => $plans->toArray()
            ]);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function createWorkoutPlanForClient(WorkoutPlanService $service, $customerId)
    {
        $workoutPlanData = request()->get('workoutPlan', []);

        // Sprawdzamy, czy zalogowany użytkownik jest trenerem
        $trainer = Auth::user();
        if (!$trainer || $trainer->role_id !== 4) {
            return response()->json([
                'status' => 401,
                'message' => 'Nieautoryzowany dostęp'
            ], 401);
        }

        try {
            $data = $service->createWorkoutPlanForSpecificCustomer($workoutPlanData, $customerId);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Plan treningowy stworzony pomyślnie dla klienta',
            'data' => $data->toArray()
        ]);
    }

    public function getWorkoutPlanCount()
    {
        $workoutPlanCount = WorkoutPlan::count(); // Zakładam, że masz model WorkoutPlan
        return response()->json(['count' => $workoutPlanCount], 200);
    }


}
