<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryAnimalRequest extends FormRequest
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
            'animal_id' => ['required'],
            'picture' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'created_by' => ['required', 'numeric'],
            'updated_by' => ['required', 'numeric'],
        ];
    }
}
