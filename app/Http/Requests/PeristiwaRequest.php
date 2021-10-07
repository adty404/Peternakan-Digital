<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeristiwaRequest extends FormRequest
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
            'animal_id' => ['required', 'numeric'],
            'tanggal' => ['required'],
            'waktu' => ['required'],
            'peristiwa' => ['required', 'in:Lahir,Datang,Sehat,Sakit,Hilang,Mati,Dijual,Pindah'],
            'keterangan' => ['required', 'max:256'],
            'created_by' => ['required', 'numeric'],
            'updated_by' => ['required', 'numeric'],
            'foto' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ];
    }
}
