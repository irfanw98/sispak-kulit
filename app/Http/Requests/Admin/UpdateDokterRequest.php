<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDokterRequest extends FormRequest
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
            'username' => 'required|min:6',
            'email' => 'required|email',
            'foto' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi!',
            'nama.min' =>   'Nama minimal diisi 3 karakter',
            'username.required' => 'Username wajib diisi',
            'username.min' => 'Username minimal diisi 6 karakter',
            'email.email' => 'Yang anda input bukan email',
            'email.required' => 'Email wajib diisi!',
            'foto.mimes' =>   'File foto harus type jpeg/png/jpg',
            'foto.max' => 'File foto maksimal ukuran 2048 kilobytes (2mb)',
        ];
    }
}
