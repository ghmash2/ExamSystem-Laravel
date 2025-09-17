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
            'name' => 'required | min:1',
            'username' => 'required | min:1 |unique:users,username| alpha_dash:ascii',
            'contact' => 'required | min:1 | max:18',
            'email' => 'required |email|unique:users,email| min:11',
            'password' => 'required | min:3 | max:15',
            'password_confirmation' => 'required | same:password',
            'image' => 'image | mimes:jpeg,jpg,png,gif | max:15024',
        ];
    }
}
