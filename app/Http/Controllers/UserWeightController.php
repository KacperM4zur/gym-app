<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\UserWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserWeightController extends Controller
{
    public function index()
    {
        return view('user_weights.index', [
            'weights' => UserWeight::with('customer')->get()
        ]);
    }

    public function edit($id = 0)
    {
        $weight = UserWeight::findOrNew($id);
        $customers = Customer::all();

        if (request()->isMethod('post')) {
            $post = request()->all();
            $redirect = redirect()->route('users-weight.index');

            $validator = validator($post, $weight->rules());

            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $weight->fill($post);
                    $weight->save();
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    return $redirect->with('error', ["{$e->getMessage()}"]);
                }

                $message = $id ? "Pomyślnie zaktualizowano wpis." : "Pomyślnie dodano nowy wpis.";
                return $redirect->with('success', [$message]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }

        return view('user_weights.edit', [
            'weight' => $weight,
            'customers' => $customers
        ]);
    }

    public function delete($id)
    {
        $weight = UserWeight::findOrFail($id);
        $weight->delete();

        return redirect()->route('users-weight.index')->with('success', ["Usunięto wpis."]);
    }
}
