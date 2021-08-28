<?php

namespace App\Http\Requests\Dokter\Penyakit;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'nama' => 'required|min:3',
            'deskripsi' => 'required',
            'solusi' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama penyakit wajib diisi!',
            'nama.min' => 'Nama penyakit minimal 3 karakter',
            'deskripsi.required' => 'Deskripsi penyakit wajib diisi!',
            'solusi.required' => 'Solusi penyakit wajib diisi!'
        ];
    }
}
