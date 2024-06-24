<?php

namespace App\Http\Controllers;

use App\Models\ExercisesGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $post = request()->all();
            $redirect = redirect()->route('exercises-group.edit', [
                'id' => $group->getKey()
            ]);

            $validator = validator($post,$group->rules());
            if($validator->passes()){
                DB::beginTransaction();
                try {
                    $group->fill($post);
                    if(request()->hasFile('image_path')){
                        $file = request()->file('image_path');
                        $filename = $file->getClientOriginalName();
                        $group->image_path = $filename;
                        $file->storeAs('public/',$filename);
                    }
                    $group->save();
                    DB::commit();
                }
                catch (\Exception $exception){
                    DB::rollBack();

                    return $redirect->with('error', ["{$exception->getMessage()}"]);
                }

                return $redirect->with('success', [$group->getKey() ? 'Pomyślnie edytowano ' . $group->name : 'Pomyślnie dodano ' . $group->name]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }
        return view('exercises-group.edit', [
            "group" => $group
        ]);
    }

    public function delete($id=0){
        $group = ExercisesGroup::findOrFail($id);
        $group->delete();

        return redirect()->route('exercises-group.index')->with('success', ["Usunięto $group->name"]);
    }

}
