<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBannerRequest extends FormRequest
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
        $bannerId = $this->route('banner');
        $rules = [
            'name' => [
                'required',
                'string',
                Rule::unique('banners', 'name')->ignore($bannerId),
            ],
        ];

        // Kiểm tra nếu có tệp ảnh được tải lên mới, thực hiện validation cho trường 'img_url'
        if ($this->hasFile('img_thumb')) {
            $rules['img_thumb'] = 'required|image|max:2048';
        }

        return $rules;
    }

}
