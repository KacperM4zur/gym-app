<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\DayResource;
use App\Services\DayService;

class DayController extends Controller
{
    public function getDays(DayService $service)
    {
        try {
            $data = $service->getDays();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => DayResource::collection($data)
        ]);
    }
}
