<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FarmRequest extends FormRequest
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
            //code
            'office_id' => ['required'],
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:office,email'],
            'phone' => ['required', 'numeric', 'unique:office,phone'],
            'pic' => ['required', 'max:255'],
        ];
    }
}
