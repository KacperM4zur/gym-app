<?php

namespace App\Http\Controllers\Api;

use App\Models\BodyPart;

class BodyPartsController extends Controller
{
    public function getterBodyParts(){
        $body_parts = BodyPart::all()->toArray();
        return response()->json($body_parts);
    }
}
