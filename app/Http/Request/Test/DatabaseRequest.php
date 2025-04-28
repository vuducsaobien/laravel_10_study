<?php

namespace App\Http\Request\Test;

use Illuminate\Foundation\Http\FormRequest;
use App\Enum\DatabaseExceptionTypesEnum;

class DatabaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'type' => [
                'required',
                'string',
                'in:' . implode(',', DatabaseExceptionTypesEnum::getValues()),
            ]
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'type.in' => config('messages.type.in'),
        ];
    }
}
