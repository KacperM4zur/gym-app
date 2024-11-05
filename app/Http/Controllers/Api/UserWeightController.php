<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserWeightController extends Controller
{
    // Pobiera historię wag dla zalogowanego użytkownika
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Użytkownik niezalogowany.',
            ], 401);
        }

        $weights = UserWeight::where('customer_id', $user->id)->get();

        return response()->json($weights, 200);
    }

    // Dodaje nowy wpis wagowy dla zalogowanego użytkownika
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'weight' => 'required|numeric|min:1',
            'date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Wystąpiły błędy walidacji.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Użytkownik niezalogowany.',
            ], 401);
        }

        $weight = new UserWeight();
        $weight->customer_id = $user->id;
        $weight->weight = $request->weight;
        $weight->date = $request->date;
        $weight->save();

        return response()->json([
            'message' => 'Pomyślnie dodano wpis wagowy.',
            'data' => $weight
        ], 201);
    }

    public function getClientWeights($customerId)
    {
        // Sprawdzenie, czy zalogowany użytkownik jest trenerem (role_id = 4)
        $user = auth()->user();
        if ($user->role_id !== 4) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Pobranie historii wag dla określonego klienta na podstawie customer_id
        $weights = UserWeight::where('customer_id', $customerId)->orderBy('created_at', 'desc')->get();

        return response()->json(['status' => 200, 'data' => $weights]);
    }

}
