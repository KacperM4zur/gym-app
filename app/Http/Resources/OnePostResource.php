<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OnePostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'customer_name' => $this->customer->name,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comments' => $this->comments->map(function ($comment) {
                return [
                    'comment_body' => $comment->body,
                    'created_at' => $comment->created_at,
                    'updated_at' => $comment->updated_at,
                ];
            })->toArray(),
        ];
    }
}
