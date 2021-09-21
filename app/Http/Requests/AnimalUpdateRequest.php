<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalUpdateRequest extends FormRequest
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
            'category_id' => ['required', 'numeric'],
            'farm_id' => ['required', 'numeric'],
            'name' => ['required', 'max:255'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'condition' => ['required', 'max:255'],
            'note' => ['required', 'max:255'],
            'created_by' => ['required', 'numeric'],
            'updated_by' => ['required', 'numeric'],
            //barcode
        ];
    }
}
