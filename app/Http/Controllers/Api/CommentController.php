<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentStoreRequest;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(CommentStoreRequest $request, $postId)
    {
        $comment = $this->commentService->createComment($postId, $request->validated());
        return response()->json(['status' => 200, 'message' => 'SUCCESS', 'data' => $comment]);
    }
}
