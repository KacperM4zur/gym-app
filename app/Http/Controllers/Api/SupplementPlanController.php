<?php
//
//namespace App\Http\Controllers\Api;
//
//use App\Models\Customer;
//use App\Services\SupplementPlanService;
//use App\Http\Controllers\Controller;
//
//class SupplementPlanController extends Controller
//{
//    public function createSupplementPlan(SupplementPlanService $service)
//    {
//        // Pobranie danych planu suplementacyjnego z requesta
//        $supplementPlanData = request()->get('supplementPlan', []);
//        $customer = Customer::find(14); // ustalony na sztywno, analogicznie
//
//        try {
//            // Tworzenie planu suplementacyjnego
//            $data = $service->createSupplementPlan($supplementPlanData, $customer);
//        } catch (\Exception $exception) {
//            // Obsługa wyjątków i zwrócenie błędu
//            return response()->json($exception->getMessage(), 400);
//        }
//
//        // Zwrócenie pozytywnej odpowiedzi z danymi nowo utworzonego planu
//        return response()->json([
//            'status' => 200,
//            'message' => 'Plan suplementacyjny stworzony pomyślnie',
//            'data' => $data->toArray()
//        ]);
//    }
//
//    public function getSupplementPlan(SupplementPlanService $service)
//    {
//        try {
//            // Pobranie planów suplementacyjnych
//            $data = $service->getSupplementPlan();
//        } catch (\Exception $exception) {
//            // Obsługa wyjątków i zwrócenie błędu
//            return response()->json($exception->getMessage(), 400);
//        }
//
//        // Zwrócenie pozytywnej odpowiedzi z danymi planów
//        return response()->json([
//            'status' => 200,
//            'message' => 'Plany suplementacyjne pobrane pomyślnie',
//            'data' => $data->toArray()
//        ]);
//    }
//}


namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Models\WorkoutPlan;
use App\Services\SupplementPlanService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplementPlanController extends Controller
{
    protected SupplementPlanService $supplementPlanService;

    public function __construct(SupplementPlanService $supplementPlanService)
    {
        $this->supplementPlanService = $supplementPlanService;
    }
    public function createSupplementPlan(SupplementPlanService $service)
    {
        // Pobranie danych planu suplementacyjnego z requesta
        $supplementPlanData = request()->get('supplementPlan', []);

        // Pobieranie zalogowanego użytkownika z tokena
        $customer = Auth::user();

        if (!$customer) {
            return response()->json([
                'status' => 401,
                'message' => 'Nieautoryzowany użytkownik'
            ], 401);
        }

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
            // Pobranie planów suplementacyjnych dla zalogowanego użytkownika
            $data = $service->getSupplementPlan(Auth::user());
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
    public function getUserSupplementPlans(SupplementPlanService $service)
    {
        try {
            // Pobranie zalogowanego użytkownika
            $customer = auth()->user();

            // Pobranie wszystkich planów suplementacyjnych dla użytkownika
            $plans = $service->getSupplementPlansForCustomer($customer);

            return response()->json([
                'status' => 200,
                'message' => 'Plany suplementacyjne pobrane pomyślnie',
                'data' => $plans->toArray()
            ]);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function deleteSupplementPlan($id, SupplementPlanService $service)
    {
        // Pobranie zalogowanego użytkownika
        $customer = Auth::user();

        try {
            // Usunięcie planu suplementacyjnego przez serwis
            $service->deleteSupplementPlan($id, $customer);
            return response()->json([
                'status' => 200,
                'message' => 'Plan suplementacyjny został pomyślnie usunięty'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => 'Wystąpił błąd podczas usuwania planu: ' . $exception->getMessage()
            ], 500);
        }
    }
    public function activate($id)
    {
        try {
            $plan = $this->supplementPlanService->activatePlan($id);
            return response()->json(['status' => 200, 'message' => 'Plan activated successfully', 'data' => $plan]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Failed to activate plan', 'error' => $e->getMessage()]);
        }
    }
    public function getActiveSupplementPlan(SupplementPlanService $service)
    {
        try {
            // Pobranie zalogowanego użytkownika
            $customer = auth()->user();

            // Pobranie aktywnego planu suplementacyjnego dla użytkownika
            $activePlan = $service->getActiveSupplementPlanForCustomer($customer);

            if (!$activePlan) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Brak aktywnego planu suplementacyjnego'
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Aktywny plan suplementacyjny pobrany pomyślnie',
                'data' => $activePlan->toArray()
            ]);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }
    public function getActiveSupplementPlanForClient($customerId)
    {
        $activePlan = $this->supplementPlanService->getActiveSupplementPlanByCustomer($customerId);
        if ($activePlan) {
            return response()->json(['status' => 200, 'data' => $activePlan]);
        } else {
            return response()->json(['status' => 404, 'message' => 'Active supplement plan not found'], 404);
        }
    }

    public function createSupplementPlanForClient($customerId, SupplementPlanService $service)
    {
        // Sprawdź, czy zalogowany użytkownik ma rolę trenera
        $trainer = Auth::user();
        if (!$trainer || $trainer->role_id != 4) {
            return response()->json([
                'status' => 403,
                'message' => 'Brak uprawnień do tworzenia planu dla klienta.'
            ], 403);
        }

        // Pobierz dane planu z requesta
        $supplementPlanData = request()->get('supplementPlan', []);

        try {
            // Wywołaj serwis do stworzenia planu suplementacyjnego
            $data = $service->createSupplementPlanForUser($supplementPlanData, $customerId);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }

        // Zwróć odpowiedź z danymi stworzonego planu
        return response()->json([
            'status' => 200,
            'message' => 'Plan suplementacyjny stworzony pomyślnie',
            'data' => $data->toArray()
        ]);
    }

    public function getClientSupplementPlans($customerId, SupplementPlanService $service)
    {
        // Sprawdzanie, czy zalogowany użytkownik ma rolę trenera
        $trainer = auth()->user();
        if ($trainer->role_id !== 4) {
            return response()->json(['status' => 403, 'message' => 'Brak dostępu'], 403);
        }

        try {
            // Pobieranie planów suplementacyjnych klienta
            $plans = $service->getSupplementPlansForClientById($customerId);

            return response()->json([
                'status' => 200,
                'message' => 'Plany suplementacyjne klienta pobrane pomyślnie',
                'data' => $plans->toArray()
            ]);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

}
