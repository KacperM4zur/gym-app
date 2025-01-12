<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required_without_all:body', 'unique:posts,title,' . $this->route('id')],
            'body' => ['required_without_all:title'],
        ];
    }
}
