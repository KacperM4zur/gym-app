<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserMaxLift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserMaxLiftController extends Controller
{
    // Pobiera historię maksymalnych ciężarów dla zalogowanego użytkownika
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Użytkownik niezalogowany.',
            ], 401);
        }

        $maxLifts = UserMaxLift::where('customer_id', $user->id)
            ->with('exercise:id,name') // Załączenie nazwy ćwiczenia
            ->get();

        return response()->json($maxLifts, 200);
    }

    // Dodaje nowy maksymalny ciężar dla zalogowanego użytkownika
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'exercise_id' => 'required|exists:exercises,id',
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

        $maxLift = new UserMaxLift();
        $maxLift->customer_id = $user->id;
        $maxLift->exercise_id = $request->exercise_id;
        $maxLift->weight = $request->weight;
        $maxLift->date = $request->date;
        $maxLift->save();

        return response()->json([
            'message' => 'Pomyślnie dodano maksymalny ciężar.',
            'data' => $maxLift->load('exercise:id,name') // Załączenie nazwy ćwiczenia
        ], 201);
    }
}
