<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserMaxLift;
use Illuminate\Http\Request;

class UserMaxLiftController extends Controller
{
    public function index()
    {
        $maxLifts = UserMaxLift::with('customer', 'exercise')->get();
        return response()->json($maxLifts, 200);
    }

    public function show($id)
    {
        $maxLift = UserMaxLift::with('customer', 'exercise')->find($id);

        if (!$maxLift) {
            return response()->json(['message' => 'Wpis nie został znaleziony'], 404);
        }

        return response()->json($maxLift, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'exercise_id' => 'required|exists:exercises,id',
            'weight' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $maxLift = UserMaxLift::create($validatedData);

        return response()->json(['message' => 'Wpis został utworzony', 'data' => $maxLift], 201);
    }

    public function update(Request $request, $id)
    {
        $maxLift = UserMaxLift::find($id);

        if (!$maxLift) {
            return response()->json(['message' => 'Wpis nie został znaleziony'], 404);
        }

        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'exercise_id' => 'required|exists:exercises,id',
            'weight' => 'required|numeric|min:0',
            'date' => 'required|date',
        ]);

        $maxLift->update($validatedData);

        return response()->json(['message' => 'Wpis został zaktualizowany', 'data' => $maxLift], 200);
    }

    public function destroy($id)
    {
        $maxLift = UserMaxLift::find($id);

        if (!$maxLift) {
            return response()->json(['message' => 'Wpis nie został znaleziony'], 404);
        }

        $maxLift->delete();

        return response()->json(['message' => 'Wpis został usunięty'], 200);
    }
}
