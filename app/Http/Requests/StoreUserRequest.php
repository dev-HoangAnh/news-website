<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string|in:client,admin',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống tên.',
            'name.string' => 'Tên phải là một chuỗi.',
            'name.max' => 'Tên chỉ tối đa 100 chữ cái.',
            'email.required' => 'Không được bỏ trống email.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.email' => 'Email phải là địa chỉ email hợp lệ.',
            'email.max' => 'Email không được lớn hơn 100 ký tự.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Không được bỏ trống mật khẩu.',
            'password.string' => 'Mật khẩu phải là một chuỗi.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'role.string' => 'Vai trò phải là một chuỗi.',
            'role.in' => 'Vai trò đã chọn không hợp lệ.',
        ];
    }
}
