<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Kiểm tra nếu là request xóa và user đang cố xóa chính mình
        if ($this->isMethod('DELETE') && $this->route('user') == auth()->id()) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];

        // Nếu là update request
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $this->route('user');
            $rules['password'] = 'nullable|string|min:8';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên người dùng là bắt buộc',
            'name.max' => 'Tên người dùng không được vượt quá 255 ký tự',
            'email.required' => 'Email là bắt buộc',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function failedAuthorization()
    {
        throw new \Illuminate\Auth\Access\AuthorizationException('Bạn không thể xóa chính mình.');
    }
} 