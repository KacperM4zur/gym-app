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
use App\Services\SupplementPlanService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplementPlanController extends Controller
{
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

    public function deleteSupplementPlan(SupplementPlanService $service, $id)
    {
        try {
            $customer = Auth::user();

            // Sprawdzenie, czy użytkownik jest zalogowany
            if (!$customer) {
                return response()->json(['error' => 'Nieautoryzowany użytkownik'], 401);
            }

            // Usunięcie planu przez serwis
            $service->deleteSupplementPlan($id, $customer);

            return response()->json(['status' => 'Plan suplementacyjny usunięty pomyślnie'], 200);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() === 403 ? 403 : 500;
            return response()->json(['error' => $e->getMessage()], $statusCode);
        }
    }


}
