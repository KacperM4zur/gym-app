<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function createComment($postId, array $data)
    {
        $post = Post::findOrFail($postId);

        // Create the comment and associate it with the authenticated user
        $comment = $post->comments()->create([
            'customer_id' => Auth::id(),
            'body' => $data['body'],
        ]);

        // Reload the comment with customer info and return
        return Comment::with('customer:id,name')->find($comment->id);
    }
}
