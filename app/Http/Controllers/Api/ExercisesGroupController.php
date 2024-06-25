<?php

namespace App\Http\Controllers\Api;

use App\Models\ExercisesGroup;

class ExercisesGroupController extends Controller
{
    public function getterExercisesGroup(){
        $groups = ExercisesGroup::where('status', '=', '1')->get()->toArray();
        return response()->json($groups);
    }
}
