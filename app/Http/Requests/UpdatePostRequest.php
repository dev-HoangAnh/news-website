<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string',
            'views' => 'integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Không để trống người dùng',
            'user_id.exists' => 'Người dùng phải tồn tại trong bảng người dùng',
            'category_id.required' => 'Không để trống danh mục',
            'category_id.exists' => 'Danh mục phải tồn tại trong bảng danh mục',
            'title.required' => 'Không để trống tiêu đề',
            'title.max' => 'Tiêu đề không được lớn hơn 255 ký tự',
            'image.image' => 'Hình ảnh phải là một tập tin hình ảnh',
            'image.mimes' => 'Hình ảnh phải là một loại tệp: jpeg, png, jpg, gif, svg',
            'image.max' => 'Hình ảnh không được lớn hơn 2048 KB',
            'content.required' => 'Không để trống nội dung',
            'views.integer' => 'Lượt xem phải là số nguyên',
            'views.min' => 'Lượt xem phải ít nhất là 0',
        ];
    }
}
