<?php

namespace App\Http\Controllers;

use App\Models\ExercisesGroup;
use Illuminate\Http\Request;

class ExercisesGroupController extends Controller
{
    public function index(){
        return view('exercises-group.index', [
            "exerciseGroups" => ExercisesGroup::all()
        ]);
    }

    public function edit($id=0) {
        $group = ExercisesGroup::findOrNew($id);
        if(request()->isMethod('post')){
            $post = collect(request()->all())->mapWithKeys(function ($item,$key){
                if(isset($item['status'])){
                    $item['status'] = 1;
                }else{
                    $item['status'] = 0;
                }
                return[$key=>$item];
            });
            dd($post);
            $status = array_key_exists('status', $post);
            dd($status);
            if(validator($post,$group->rules())->passes()){
                $group->fill($post);
                $group->save();

                return redirect()->route('exercises-group.edit', [
                    'id' => $group->getKey()
                ]);
            }
        }
        return view('exercises-group.edit', [
            "group" => $group
        ]);
    }

}
