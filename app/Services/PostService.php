<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Collection;

class PostService
{
    public function getPosts(): Collection
    {
        return Post::with(['customer'])->get();
    }

    public function createPost($data): Post
    {
        return Post::create($data);
    }

    public function showPost($id): ?Post
    {
        return Post::with(['customer', 'comments.customer'])->find($id);
    }

    public function updatePost($data, $id): bool
    {
        return Post::find($id)->update($data);
    }

    public function deletePost($id): ?bool
    {
        return optional(Post::find($id))->delete();
    }
}
