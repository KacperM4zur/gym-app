<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPosts();
        return response()->json(['status' => 200, 'message' => 'SUCCESS', 'data' => $posts]);
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        return response()->json(['status' => 200, 'message' => 'SUCCESS', 'data' => $post]);
    }

    public function store(PostStoreRequest $request)
    {
        $post = $this->postService->createPost($request->validated());
        return response()->json(['status' => 200, 'message' => 'SUCCESS', 'data' => $post]);
    }

    public function update(PostUpdateRequest $request, $id)
    {
        try {
            $post = $this->postService->updatePost($id, $request->validated());
            return response()->json(['status' => 200, 'message' => 'SUCCESS', 'data' => $post]);
        } catch (\Exception $e) {
            return response()->json(['status' => Response::HTTP_FORBIDDEN, 'message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
    }

    public function delete($id)
    {
        try {
            $this->postService->deletePost($id);
            return response()->json(['status' => 200, 'message' => 'Post deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => Response::HTTP_FORBIDDEN, 'message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }
    }
}
