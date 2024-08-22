<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'emp_name' =>'nullable|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_fname' =>'nullable|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_mname' =>'nullable|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_preaddress' =>'nullable|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_peraddress' =>'nullable|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_email' =>'nullable|email|unique:employees,email',
            'emp_phone' =>'nullable|digits:11',
            'emp_age' =>'nullable|numeric',
            'emp_nid' =>'nullable|numeric',
            'emp_experience' =>'nullable|string',
            'emp_position' =>'nullable|string',
            'emp_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'ssc' =>'nullable|numeric',
            'hsc' =>'nullable|numeric',
            'bba' =>'nullable|numeric',
            'emp_salary' =>'nullable|numeric',
            'emp_join' =>'nullable|date',
            'emp_note' =>'nullable|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/'
        ];
    }
}
