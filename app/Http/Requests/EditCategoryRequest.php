<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCategoryRequest extends FormRequest
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
    // protected function prepareForValidation()
    // {
    //     // Lấy ID của bản ghi đang được chỉnh sửa từ URL và truyền vào biến $category
    //     $categoryId = $this->route('category');
    //     $this->merge([
    //         'category' => Category::findOrFail($categoryId),
    //     ]);
    // }

    public function rules(): array

    {
        // $category = $this->input('category');
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Rule::unique('categories')->ignore($category), // Thay "categories" bằng tên bảng "categories" của bạn.
            ],
        ];
    }
}
