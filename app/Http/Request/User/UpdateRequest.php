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

        // Nếu có password mới thì thêm rule validate password
        // if ($this->has('password')) {
        //     $rules['password'] = [
        //         'required',
        //         'string',
        //         'min:8',
        //         'confirmed'
        //     ];
        //     $rules['confirm_password'] = [
        //         'required',
        //         'string',
        //         'min:8',
        //         'same:password'
        //     ];
        // }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.string' => config('messages.name.string'),
            'name.max' => config('messages.name.max'),
            'email.email' => config('messages.email.email'),
            'email.unique' => config('messages.email.unique'),
            // 'password.required' => config('messages.password.required'),
            // 'password.string' => config('messages.password.string'),
            // 'password.min' => config('messages.password.min'),
            // 'password.confirmed' => config('messages.password.confirmed'),
            // 'password_confirmation.required' => config('messages.password_confirmation.required'),
            // 'password_confirmation.string' => config('messages.password_confirmation.string')
        ];
    }
}
