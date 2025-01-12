<?php

namespace App\Http\Controllers\Api;

use App\Models\Exercise;


class ExerciseController extends Controller
{
    public function getterExercises(){
        $exercises = Exercise::where('status', '=', '1')->get()->toArray();
        return response()->json($exercises);
    }

    public function getExercisesByGroup($groupId){
        $exercises = Exercise::where('exercises_group_id', '=', $groupId)
            ->where('status', '=', '1')
            ->get()->toArray();
        return response()->json($exercises);
    }
}
