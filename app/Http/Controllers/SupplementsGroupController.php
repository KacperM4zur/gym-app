<?php

namespace App\Http\Controllers;

use App\Models\SupplementsGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SupplementsGroupController extends Controller
{
    public function index() {
        return view('supplements-group.index', [
            'supplementsGroups' => SupplementsGroup::all()
        ]);
    }

    public function edit($id = 0) {
        $group = SupplementsGroup::findOrNew($id);
        $isNew = !$group->exists;
        if(request()->isMethod('post')){
            $post = request()->all();
            $redirect = redirect()->route('supplements-group.edit', [
                'id' => $group->getKey()
            ]);

            $validator = validator($post, $group->rules());
            if($validator->passes()){
                DB::beginTransaction();
                try {
                    $group->fill($post);
                    if(request()->hasFile('image_path')){
                        if ($group->image_path) {
                            Storage::delete('public/' . $group->image_path);
                        }
                        $file = request()->file('image_path');
                        $filename = $file->getClientOriginalName();
                        $group->image_path = $filename;
                        $file->storeAs('public/', $filename);
                    }

                    $group->save();
                    DB::commit();
                }
                catch (\Exception $exception){
                    DB::rollBack();

                    return $redirect->with('error', ["{$exception->getMessage()}"]);
                }

                $message = $isNew ? 'Pomyślnie dodano ' . $group->name : 'Pomyślnie edytowano ' . $group->name;
                return $redirect->with('success', [$message]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }
        return view('supplements-group.edit', [
            'group' => $group
        ]);
    }

    public function delete($id = 0) {
        $group = SupplementsGroup::findOrFail($id);

        if ($group->image_path) {
            Storage::delete('public/' . $group->image_path);
        }

        $group->delete();

        return redirect()->route('supplements-group.index')->with('success', ["Usunięto $group->name"]);
    }
}
