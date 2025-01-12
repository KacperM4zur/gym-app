<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getAllPosts()
    {
        return Post::with('customer:id,name', 'comments.customer:id,name')
            ->latest()
            ->get();
    }

    public function getPostById($postId)
    {
        return Post::with(['customer:id,name', 'comments.customer:id,name'])
            ->findOrFail($postId);
    }

    public function createPost(array $data)
    {
        return Post::create([
            'customer_id' => Auth::id(),
            'title' => $data['title'],
            'body' => $data['body'],
        ]);
    }

    public function updatePost($postId, array $data)
    {
        $post = Post::findOrFail($postId);

        if ($post->customer_id !== Auth::id()) {
            throw new \Exception("Unauthorized");
        }

        $post->update($data);
        return $post;
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);

        // Dodaj sprawdzenie, czy autoryzowany użytkownik jest właścicielem posta
        if ($post->customer_id !== Auth::id()) {
            throw new \Exception("Unauthorized to delete this post");
        }

        $post->delete();
        return true;
    }
}
