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
}
