<?php

namespace App\Http\Controllers;

use App\Models\BodyPart;
use App\Models\ExercisesGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BodyPartController extends Controller
{
    public function index(){
        return view('body_parts.index', [
            "bodyParts" => BodyPart::all()
        ]);
    }

    public function edit($id=0) {
        $bodyPart = BodyPart::findOrNew($id);
        $isNew = !$bodyPart->exists;

        if(request()->isMethod('post')){
            $post = request()->all();
            $redirect = redirect()->route('body-parts.index');

            $validator = validator($post, $bodyPart->rules());
            if($validator->passes()){
                DB::beginTransaction();
                try {
                    $bodyPart->fill($post);
                    $bodyPart->save();
                    DB::commit();
                }
                catch (\Exception $exception){
                    DB::rollBack();
                    return $redirect->with('error', ["{$exception->getMessage()}"]);
                }

                $message = $isNew ? 'Pomyślnie dodano ' . $bodyPart->name : 'Pomyślnie edytowano ' . $bodyPart->name;
                return $redirect->with('success', [$message]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }

        return view('body_parts.edit', [
            "bodyPart" => $bodyPart
        ]);
    }

    public function delete($id=0){
        $body_part = BodyPart::findOrFail($id);
        $body_part->delete();

        return redirect()->route('body-parts.index')->with('success', ["Usunięto $body_part->name"]);
    }

}
