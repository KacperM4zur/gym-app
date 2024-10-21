<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserWeightController extends Controller
{
    public function index()
    {
        $weights = UserWeight::all();
        return response()->json($weights, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'weight' => 'required|numeric|min:1',
            'date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Wystąpiły błędy walidacji.',
                'errors' => $validator->errors()
            ], 422);
        }

        $weight = new UserWeight();
        $weight->customer_id = $request->customer_id;
        $weight->weight = $request->weight;
        $weight->date = $request->date;
        $weight->save();

        return response()->json([
            'message' => 'Pomyślnie dodano wpis wagowy.',
            'data' => $weight
        ], 201);
    }

    public function show($id)
    {
        $weight = UserWeight::find($id);

        if (!$weight) {
            return response()->json([
                'message' => 'Nie znaleziono wpisu wagowego.'
            ], 404);
        }

        return response()->json($weight, 200);
    }

    public function update(Request $request, $id)
    {
        $weight = UserWeight::find($id);

        if (!$weight) {
            return response()->json([
                'message' => 'Nie znaleziono wpisu wagowego.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'weight' => 'required|numeric|min:1',
            'date' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Wystąpiły błędy walidacji.',
                'errors' => $validator->errors()
            ], 422);
        }

        $weight->customer_id = $request->customer_id;
        $weight->weight = $request->weight;
        $weight->date = $request->date;
        $weight->save();

        return response()->json([
            'message' => 'Pomyślnie zaktualizowano wpis wagowy.',
            'data' => $weight
        ], 200);
    }

    public function delete($id)
    {
        $weight = UserWeight::find($id);

        if (!$weight) {
            return response()->json([
                'message' => 'Nie znaleziono wpisu wagowego.'
            ], 404);
        }

        $weight->delete();

        return response()->json([
            'message' => 'Pomyślnie usunięto wpis wagowy.'
        ], 200);
    }
}
