<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;

class CommentService
{
    public function storeComment($data, $id): ?Comment
    {
        $post = Post::find($id);

        if (!$post) {
            return null;
        }

        $data['post_id'] = $id;
        return Comment::create($data);
    }
}
