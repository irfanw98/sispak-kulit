<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchCurrentPassword;

class UbahPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password_lama' => ['required', new MatchCurrentPassword],
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'password_lama.required' => 'Password Lama Wajib Diisi!',
            'password.required' => 'Password Baru Wajib Diisi!',
            'password.min' => 'Password Minimal 6 Karakter',
            'password_confirmation.required' => 'Password Konfirmasi Wajib Diisi!',
            'password_confirmation.same' => 'Password Tidak Sesuai Password Baru!',
             
        ];
    }
}
