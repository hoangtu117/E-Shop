<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'img_thumb' =>'required|image|max:2048',
            'category_id' => 'required|exists:categories,id', // Kiểm tra xem category_id có tồn tại trong bảng 'categories' không.
            'desc' => 'required|string|max:255', // Cho phép descrip có thể là null hoặc là một chuỗi.
            'so_luong' => 'required|integer|min:1', // Số lượng phải là một số nguyên không âm.
        ];
    }
}
