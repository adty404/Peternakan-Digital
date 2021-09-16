<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserOfficeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            // email_verified_at
            'password' => ['required','min:6'],
            // remember token
            'created_by' => ['required', 'numeric'],
            'updated_by' => ['required', 'numeric'],
            // role
            // code
        ];
    }
}
