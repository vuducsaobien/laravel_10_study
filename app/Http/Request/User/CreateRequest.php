<?php

namespace App\Http\Request\User;

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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => config('messages.name.required'),
            'name.string' => config('messages.name.string'),
            'name.max' => config('messages.name.max'),
            'email.required' => config('messages.email.required'),
            'email.email' => config('messages.email.email'),
            'email.unique' => config('messages.email.unique'),
        ];
    }
}
