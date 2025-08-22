<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'password' => 'required|min:8'
        ];
    }

    // public function messages() : array
    // {
    //     return [
    //         'name.required' => 'Name is required.',
    //         'email.required' => 'Email is required.',
    //         'phone.required' => 'Phone Number is required.',
    //         'phone.numeric' => 'Phone is numeric',
    //         'password.required' => 'Password is required.',
    //         'password.min' => 'Password must be at least 8 characters',
    //     ];
    // }
}
