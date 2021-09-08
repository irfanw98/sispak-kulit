<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UbahPassword;
use App\Models\User;

class PasswordController extends Controller
{
    public function index()
    {
        return view('password.index');
    }

    public function store(UbahPassword $request)
    {
        $passwordDefault = Auth::user()->password;
        $passwordSekarang = request('password_lama');
        $userId = Auth::user()->id;

        if(Hash::check($passwordSekarang, $passwordDefault)) {
            $user = User::findOrfail($userId);
            $user->password = Hash::make($request->input('password'));

            if($user->save()) {
                return redirect('/ubah-password');
            } else {
                return redirect('/ubah-password');
            }
        } else {
            return redirect('/ubah-password');
        }

    }
}
