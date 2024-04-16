<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVoucherRequest extends FormRequest
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
        $voucherId = $this->route('voucher'); // Lấy id của voucher từ route

        return [
            'code' => [
                'required',
                'string',
                Rule::unique('vouchers', 'code')->ignore($voucherId),
            ],
            'expiration_date' => 'required|date|after_or_equal:today',
            'usage_limit' => 'integer|min:1',
            'value' => 'required|numeric|min:0',
            // Thêm các quy tắc xác thực khác nếu cần
        ];
    }
}
