<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => 'min:1',
            'username' => 'min:1 | alpha_dash:ascii|unique:users,username',
            'contact' => 'min:1 | max:18',
            'email' => 'min:11|unique:users,email',
            'password' => 'min:3 |confirmed | max:15',
            'image' => 'image | mimes:jpeg,jpg,png,gif | max:15024',
        ];
    }
}
