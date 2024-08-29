<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(){
        return view('customers.index', [
            "customers" => Customer::all()
        ]);
    }

    public function edit($id = 0) {
//        Customer::create([
//            'name' => "kamiltestuje",
//            'email' => "kamil@o2.pl",
//            'password' => "test1",
//            'api_token' => Str::random(60),
//            'role_id' => 1
//        ]);
        $customer = Customer::findOrNew($id);
        $roles = Role::all();
        $isNew = !$customer->exists;

        if(request()->isMethod('post')){
            $post = request()->all();
            $redirect = redirect()->route('customers.index');

            $rules = $isNew ? array_merge($customer->rules(), ['password' => 'required|string']) : $customer->rules();
            $validator = Validator::make($post, $rules);

            if($validator->passes()){
                DB::beginTransaction();
                try {
                    $customer->fill($post);
                    if($isNew){
                        $customer->generateApiToken();
                        $customer->password = Hash::make($post['password']);
                    }
                    $customer->save();
                    DB::commit();
                }
                catch (\Exception $exception){
                    DB::rollBack();
                    return $redirect->with('error', ["{$exception->getMessage()}"]);
                }

                $message = $isNew ? 'Pomyślnie dodano ' . $customer->name : 'Pomyślnie edytowano ' . $customer->name;
                return $redirect->with('success', [$message]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }

        return view('customers.edit', [
            "customer" => $customer,
            "roles" => $roles
        ]);
    }

    public function delete($id=0){
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')->with('success', ["Usunięto $customer->name"]);
    }
}
