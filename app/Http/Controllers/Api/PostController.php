<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function get()
    {
        try {
            $data = $this->postService->getPosts();
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => PostResource::collection($data)
        ]);
    }

    public function store(PostStoreRequest $request)
    {
        try {
            $data = $this->postService->createPost($request->toArray());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data->toArray()
        ]);
    }

    public function show($id)
    {
        try {
            $data = $this->postService->showPost($id);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data
        ]);
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $data = $this->postService->updatePost($request->toArray(), $id);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
        return response()->json([
            'status' => 200,
            'message' => 'SUCCESS',
            'data' => $data
        ]);
    }

    public function delete($id)
    {
        try {
            $data = $this->postService->deletePost($id);
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
