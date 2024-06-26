<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
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
}
