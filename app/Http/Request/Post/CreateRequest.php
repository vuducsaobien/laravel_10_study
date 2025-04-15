<?php

namespace App\Http\Request\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => config('messages.title.required'),
            'title.string' => config('messages.title.string'),
            'title.max' => config('messages.title.max'),
            'content.required' => config('messages.content.required'),
            'content.string' => config('messages.content.string'),
            'author_id.integer' => config('messages.author_id.integer'),
            'author_id.exists' => config('messages.author_id.exists'),
        ];
    }
}
