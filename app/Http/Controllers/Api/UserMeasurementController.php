<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserMeasurementController extends Controller
{
    public function index()
    {
        $measurements = UserMeasurement::all();
        return response()->json($measurements);
    }

    public function show($id)
    {
        $measurement = UserMeasurement::find($id);

        if ($measurement) {
            return response()->json($measurement);
        } else {
            return response()->json(['message' => 'Measurement not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'body_part_id' => 'required|exists:body_parts,id',
            'measurement' => 'required|numeric',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $measurement = UserMeasurement::create($request->all());

        return response()->json(['message' => 'Measurement created successfully', 'data' => $measurement], 201);
    }

    public function update(Request $request, $id)
    {
        $measurement = UserMeasurement::find($id);

        if (!$measurement) {
            return response()->json(['message' => 'Measurement not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'body_part_id' => 'required|exists:body_parts,id',
            'measurement' => 'required|numeric',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $measurement->update($request->all());

        return response()->json(['message' => 'Measurement updated successfully', 'data' => $measurement], 200);
    }

    public function destroy($id)
    {
        $measurement = UserMeasurement::find($id);

        if (!$measurement) {
            return response()->json(['message' => 'Measurement not found'], 404);
        }

        $measurement->delete();

        return response()->json(['message' => 'Measurement deleted successfully'], 200);
    }
}
