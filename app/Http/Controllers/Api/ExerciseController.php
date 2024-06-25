<?php

namespace App\Http\Controllers\Api;

use App\Models\ExercisesGroup;

class ExerciseController extends Controller
{
    public function getterExercises(){
        $exercises = ExercisesGroup::where('status', '=', '1')->get()->toArray();
        return response()->json($exercises);
    }
}
