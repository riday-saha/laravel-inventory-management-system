<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'customer_name' => 'required|string|max:60|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'customer_address' => 'required|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'customer_phone' => 'required|digits:11',
            'customer_nid' => 'nullable|numeric',
            'customer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'customer_note' => 'nullable|string|',
        ];
    }
}
