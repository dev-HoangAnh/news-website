<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'role' => 'nullable|string|in:client,admin',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống tên.',
            'name.string' => 'Tên phải là một chuỗi.',
            'name.max' => 'Tên chỉ tối đa 100 chữ cái.',
            'role.string' => 'Vai trò phải là một chuỗi.',
            'role.in' => 'Vai trò đã chọn không hợp lệ.',
        ];
    }

}
