<?php

namespace App\Http\Controllers;

use App\Models\ExercisesGroup;
use Illuminate\Http\Request;

class ExercisesGroupController extends Controller
{
    public function index(){
//        $e = ExercisesGroup::create([
//            'name' => 'abc',
//            'description' => 'opis',
//            'image_path' => 'opis'
//        ]);

//        $e = ExercisesGroup::all()->pluck('name');
//        dd($e);
        return view('exercises-group.index');
    }

    public function edit(){
        return view('exercises-group.edit');
    }

}
