<?php

namespace App\Http\Request\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'title' => [
                'sometimes',
                'string',
                'max:255'
            ],
            'content' => [
                'sometimes',
                'string',
            ],
            'author_id' => [
                'sometimes',
                'exists:users,id',
            ]
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'title.string' => config('messages.title.string'),
            'title.max' => config('messages.title.max'),
            'content.string' => config('messages.content.string'),
            'author_id.exists' => config('messages.author_id.exists'),
        ];
    }
}
