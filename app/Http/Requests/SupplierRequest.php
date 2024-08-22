<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'supplier_name' =>'required|string|max:50',
            'supplier_address' => 'required|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/|max:250',
            'supplier_phone' => 'required|digits:11',
            'supplier_nid' => 'numeric|nullable',
            'supplier_image' =>'nullable|image|mimes:jpeg,png,jpg,gif'
        ];
    }
}
