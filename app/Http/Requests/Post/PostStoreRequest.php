<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'unique:posts,title', 'max:255'],
            'body' => ['required'],
            'customer_id' => ['required'],
        ];
    }
}
