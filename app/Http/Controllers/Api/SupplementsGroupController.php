<?php

namespace App\Http\Controllers\Api;

use App\Models\SupplementsGroup;

class SupplementsGroupController extends Controller
{
    public function getterSupplementsGroup(){
        $supplements_group = SupplementsGroup::where('status', '=', '1')->get()->toArray();
        return response()->json($supplements_group);
    }
}
