<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'emp_name' =>'required|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_fname' =>'required|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_mname' =>'required|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_preaddress' =>'required|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_peraddress' =>'nullable|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/',
            'emp_email' =>'required|email|unique:employees,email',
            'emp_phone' =>'required|digits:11',
            'emp_age' =>'required|numeric',
            'emp_nid' =>'required|numeric',
            'emp_experience' =>'nullable|string',
            'emp_position' =>'nullable|string',
            'emp_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'ssc' =>'nullable|numeric',
            'hsc' =>'nullable|numeric',
            'bba' =>'nullable|numeric',
            'emp_salary' =>'required|numeric',
            'emp_join' =>'required|date',
            'emp_note' =>'nullable|string|regex:/^[\s\S]*[a-zA-Z]+[\s\S]*$/'

        ];
    }
}
