<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExercisesGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
{
    public function index(){
        $exercises = Exercise::with('exercisesGroup')->get();
        return view('exercises.index', [
            'exercises' => $exercises
        ]);
    }

    public function edit($id = 0)
    {
        $exercise = Exercise::findOrNew($id);
        $isNew = !$exercise->exists;

        $exerciseGroups = ExercisesGroup::all();

        if (request()->isMethod('post')) {
            $post = request()->all();
            $redirect = redirect()->route('exercises.index');

            $validator = validator($post, $exercise->rules());
            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $exercise->fill($post);
                    if (request()->hasFile('image_path')) {
                        if ($exercise->image_path) {
                            Storage::delete('public/' . $exercise->image_path);
                        }
                        $file = request()->file('image_path');
                        $filename = $file->getClientOriginalName();
                        $exercise->image_path = $filename;
                        $file->storeAs('public/', $filename);
                    }

                    $exercise->save();
                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();

                    return $redirect->with('error', ["{$exception->getMessage()}"]);
                }

                $message = $isNew ? 'Pomyślnie dodano ' . $exercise->name : 'Pomyślnie edytowano ' . $exercise->name;
                return $redirect->with('success', [$message]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }

        return view('exercises.edit', [
            'exercise' => $exercise,
            'exerciseGroups' => $exerciseGroups
        ]);
    }


    public function delete($id=0){
        $exercise = Exercise::findOrFail($id);

        if ($exercise->image_path) {
            Storage::delete('public/' . $exercise->image_path);
        }

        $exercise->delete();

        return redirect()->route('exercises.index')->with('success', ["Usunięto $exercise->name"]);
    }
}
