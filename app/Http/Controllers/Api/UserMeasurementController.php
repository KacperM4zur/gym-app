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

    public function getClientMeasurements($customerId)
    {
        $user = auth()->user();
        if ($user->role_id !== 4) { // Sprawdzamy, czy użytkownik jest trenerem
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $measurements = UserMeasurement::where('customer_id', $customerId)
            ->with('bodyPart') // Ładujemy nazwę części ciała
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($measurement) {
                return [
                    'id' => $measurement->id,
                    'customer_id' => $measurement->customer_id,
                    'body_part' => $measurement->bodyPart->name, // Pobieramy nazwę części ciała
                    'date' => $measurement->date,
                    'measurement' => $measurement->measurement,
                    'created_at' => $measurement->created_at,
                    'updated_at' => $measurement->updated_at,
                ];
            });

        return response()->json(['status' => 200, 'data' => $measurements]);
    }


}
