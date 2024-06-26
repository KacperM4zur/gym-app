<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use App\Models\SupplementsGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SupplementController extends Controller
{
    public function index() {
        return view('supplements.index', [
            'supplements' => Supplement::with('supplementsGroup')->get()
        ]);
    }

    public function edit($id = 0) {
        $supplement = Supplement::findOrNew($id);
        $isNew = !$supplement->exists;
        $supplementsGroups = SupplementsGroup::all();
        if(request()->isMethod('post')){
            $post = request()->all();
            $redirect = redirect()->route('supplements.index');

            $validator = validator($post, $supplement->rules());
            if($validator->passes()){
                DB::beginTransaction();
                try {
                    $supplement->fill($post);
                    if(request()->hasFile('image_path')){
                        if ($supplement->image_path) {
                            Storage::delete('public/' . $supplement->image_path);
                        }
                        $file = request()->file('image_path');
                        $filename = $file->getClientOriginalName();
                        $supplement->image_path = $filename;
                        $file->storeAs('public/', $filename);
                    }

                    $supplement->save();
                    DB::commit();
                }
                catch (\Exception $exception){
                    DB::rollBack();

                    return $redirect->with('error', ["{$exception->getMessage()}"]);
                }

                $message = $isNew ? 'Pomyślnie dodano ' . $supplement->name : 'Pomyślnie edytowano ' . $supplement->name;
                return $redirect->with('success', [$message]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }
        return view('supplements.edit', [
            'supplement' => $supplement,
            'supplementsGroups' => $supplementsGroups
        ]);
    }

    public function delete($id = 0) {
        $supplement = Supplement::findOrFail($id);

        if ($supplement->image_path) {
            Storage::delete('public/' . $supplement->image_path);
        }

        $supplement->delete();

        return redirect()->route('supplements.index')->with('success', ["Usunięto $supplement->name"]);
    }
}
