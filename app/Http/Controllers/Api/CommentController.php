<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Comment\CommentStoreRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
    public function store(CommentService $service, CommentStoreRequest $request, $id)
    {
        try {
            $data = $service->storeComment($request->toArray(), $id);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data
        ]);
    }
}
