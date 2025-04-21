<?php

namespace App\Http\Request\User;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'email' => [
                'required',
                'email',
                'exists:users,email'
            ]
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'email.email' => config('messages.email.email'),
            'email.exists' => config('messages.email.exists'),
        ];
    }
}
