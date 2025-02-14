<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advice;
use Illuminate\Http\Request;

class AdviceController extends Controller
{
    // Pobieranie wszystkich porad dla danego użytkownika
    public function index($customerId)
    {
        try {
            $advice = Advice::where('customer_id', $customerId)->get();
            return response()->json([
                'status' => 200,
                'message' => 'SUCCESS',
                'data' => $advice
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getUserAdvices()
    {
        try {
            // Pobiera ID zalogowanego użytkownika
            $customerId = auth()->id();

            // Pobiera porady dla tego użytkownika
            $advice = Advice::where('customer_id', $customerId)->get();

            return response()->json([
                'status' => 200,
                'message' => 'SUCCESS',
                'data' => $advice
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR',
                'error' => $e->getMessage()
            ]);
        }
    }


    // Tworzenie nowej porady
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'advice' => 'required|string|max:1000',
        ]);

        try {
            $advice = new Advice();
            $advice->customer_id = $request->customer_id;
            $advice->advice = $request->advice;
            $advice->save();

            return response()->json([
                'status' => 200,
                'message' => 'SUCCESS',
                'data' => $advice
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR',
                'error' => $e->getMessage()
            ]);
        }
    }

    // Aktualizacja istniejącej porady
    public function update(Request $request, $id)
    {
        $request->validate([
            'advice' => 'required|string|max:1000',
        ]);

        try {
            $advice = Advice::findOrFail($id);
            $advice->advice = $request->advice;
            $advice->save();

            return response()->json([
                'status' => 200,
                'message' => 'SUCCESS',
                'data' => $advice
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR',
                'error' => $e->getMessage()
            ]);
        }
    }

    // Usuwanie porady
    public function delete($id)
    {
        try {
            $advice = Advice::findOrFail($id);
            $advice->delete();

            return response()->json([
                'status' => 200,
                'message' => 'SUCCESS',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getClientAdvices($customerId)
    {
        $user = auth()->user();
        if ($user->role_id !== 4) { // Sprawdzamy, czy użytkownik jest trenerem
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $advices = Advice::where('customer_id', $customerId)->get();
        return response()->json(['status' => 200, 'data' => $advices]);
    }

    public function createAdvice(Request $request, $customerId)
    {

        $user = auth()->user();
        if ($user->role_id !== 4) { // Sprawdzamy, czy użytkownik jest trenerem
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'content' => 'required|string',
        ]);

        $advice = new Advice([
            'customer_id' => $customerId,
            'content' => $validatedData['content'],
        ]);

        $advice->save();

        return response()->json(['status' => 201, 'data' => $advice]);
    }


}
