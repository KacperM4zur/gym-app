<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserMeasurementController extends Controller
{
    // Pobiera historię pomiarów dla zalogowanego użytkownika
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'Użytkownik niezalogowany.',
            ], 401);
        }

        $measurements = UserMeasurement::where('customer_id', $user->id)
            ->with('bodyPart:id,name') // Załączenie nazwy części ciała
            ->get();

        return response()->json($measurements, 200);
    }

    // Dodaje nowy wpis pomiarowy dla zalogowanego użytkownika
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body_part_id' => 'required|exists:body_parts,id',
            'measurement' => 'required|numeric|min:1',
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

        $measurement = new UserMeasurement();
        $measurement->customer_id = $user->id;
        $measurement->body_part_id = $request->body_part_id;
        $measurement->measurement = $request->measurement;
        $measurement->date = $request->date;
        $measurement->save();

        return response()->json([
            'message' => 'Pomyślnie dodano wpis pomiarowy.',
            'data' => $measurement->load('bodyPart:id,name') // Załączenie nazwy części ciała
        ], 201);
    }
}
