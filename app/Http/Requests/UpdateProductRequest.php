<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product_names' => 'nullable|string|max:255',
            'product_codes' => 'nullable|string|max:255|min:4',
            'categorys' => 'nullable',
            'suppliers' => 'nullable',
            'godauns' => 'nullable|string|max:255',
            'buying_dates' => 'nullable|date',
            'expire_dates' => 'nullable|date|after_or_equal:buying_date',
            'buying_prices' => 'nullable|numeric|min:0',
            'selling_prices' => 'nullable|numeric|min:0',
            'product_images' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
