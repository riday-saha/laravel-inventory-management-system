<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255|unique:products,product_code|min:4',
            'category' => 'required',
            'supplier' => 'required',
            'godaun' => 'required|string|max:255',
            'buying_date' => 'required|date',
            'expire_date' => 'nullable|date|after_or_equal:buying_date',
            'buying_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
