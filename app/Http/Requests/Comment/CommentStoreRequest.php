<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'body' => ['required'],
            'customer_id' => ['required', 'exists:customers,id'],
        ];
    }
}
