<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::with('customers')->get();
        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    public function edit($id = 0)
    {
        $role = Role::findOrNew($id);
        $isNew = !$role->exists;

        if (request()->isMethod('post')) {
            $post = request()->all();
            $redirect = redirect()->route('roles.index');

            // Validate the input
            $validator = validator($post, [
                'name' => 'required|string|max:255'
            ]);

            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $role->fill($post);
                    $role->save();

                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();

                    return $redirect->with('error', ["{$exception->getMessage()}"]);
                }

                $message = $isNew ? 'Pomyślnie dodano ' . $role->name : 'Pomyślnie edytowano ' . $role->name;
                return $redirect->with('success', [$message]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }

        return view('roles.edit', [
            'role' => $role
        ]);
    }

    public function delete($id=0){
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('roles.index')->with('success', ["Usunięto $role->name"]);
    }
}
