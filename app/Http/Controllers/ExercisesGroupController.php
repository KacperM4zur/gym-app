<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExercisesGroupController extends Controller
{
    public function index(){
        return view('exercises-group.index');
    }

}
