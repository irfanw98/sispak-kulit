<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $users = User::findOrFail($id);
        
        if(Auth::user()->id == $id) {
            return view('user.profile.edit', compact('users'));
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $users = User::findOrFail($id);
        
        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = base64_encode(time()) . '.' . $extension;
            $file->move('storage/user', $filename);
            $oldFilename = $users->foto;
            $users->foto = $filename;
            Storage::disk('public')->delete("user/" . $oldFilename);
        } else {
            $filename = $users->foto;
        }

        $users->nama = $request->nama;
        $users->email = $request->email;
        $users->foto = $filename;
        $users->save();

        return redirect()->back();
    }
}
