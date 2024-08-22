<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'customer_name' =>'nullable|string|max:50',
            'customer_address' => 'nullable|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/|max:250',
            'customer_phone' => 'nullable|digits:11',
            'customer_nid' => 'numeric|nullable',
            'customer_image' =>'nullable|image|mimes:jpeg,png,jpg,gif',
            'customer_note' => 'nullable|string|',
        ];
    }
}
