<?php

namespace App\Http\Request\User;

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
            'name' => [
                'sometimes',
                'string',
                'max:255'
            ],
            'email' => [
                'sometimes',
                'email',
                'unique:users,email,' . $this->route('id')
            ]
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.string' => config('messages.name.string'),
            'name.max' => config('messages.name.max'),
            'email.email' => config('messages.email.email'),
            'email.unique' => config('messages.email.unique'),
        ];
    }
}
