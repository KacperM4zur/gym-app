<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplement;

class SupplementController extends Controller
{
    public function getterSupplements(){
        $supplements = Supplement::where('status', '=', '1')->get()->toArray();
        return response()->json($supplements);
    }
}
