<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;

class CustomerController extends Controller
{
    public function register()
    {
        $post = request()->only([
            'name',
            'email',
            'password'
        ]);
        $validator = Validator::make($post, [
            'name' => 'required|string|unique:customers,name',
            'email' => 'required|email|string|unique:customers,email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        DB::beginTransaction();
        try {
            $customer = new Customer();
            $customer->fill($post);
            $customer->generateApiToken();
            $customer->save();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'Klient pomyślnie zarejestrowany',
            'customer' => $customer->toArray()
        ]);
    }

    public function login(){

        $post = request()->only([
           'email',
           'password'
        ]);

        $validator = Validator::make($post, [
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $customer = $this->attempt($post);
        if(!$customer){
            return response()->json([
                'status' => 401,
                'message' => 'Klient niezalogowany',
                'customer' => []
            ]);
        }
        $customer->generateApiToken();
        $customer->save();

        return response()->json([
            'status' => 200,
            'message' => 'Klient zalogowany',
            'customer' => $customer->toArray()
        ]);
    }



    private function attempt(array $credentials): ?Customer {
        $customer = Customer::where('email', '=', $credentials['email'])->first();
        if($customer){
            return Hash::check($credentials['password'], $customer->password) ? $customer : null;

        }
        return null;
    }

    public function getTrainers()
    {
        // Filtruje tylko użytkowników z role_id = 4
        $trainers = Customer::where('role_id', 4)->get();
        return response()->json($trainers, 200);
    }

    public function getClients()
    {
        // Filtruje tylko użytkowników z role_id innym niż 4
        $clients = Customer::where('role_id', '!=', 4)->get();
        return response()->json($clients, 200);
    }

    public function getClientCount()
    {
        // Liczy użytkowników z role_id innym niż 4
        $clientCount = Customer::where('role_id', '!=', 4)->count();
        return response()->json(['count' => $clientCount], 200);
    }


}
