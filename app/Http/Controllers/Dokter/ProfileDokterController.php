<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
    Dokter,
    User
};

class ProfileDokterController extends Controller
{
    public function edit($id)
    {
       $dokter = Dokter::with('user')->where('user_id', $id)->first();
       
       if(Auth::user()->id == $id) {
            return view('dokter.profile.edit', compact('dokter'));
       } else {
            return redirect()->back();
       }
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        
        if($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = base64_encode(time()) . '.' . $extension;
            $file->move('storage/dokter', $filename);
            $oldFilename = $dokter->foto;
            $dokter->foto = $filename;
            Storage::disk('public')->delete("dokter/" . $oldFilename);
        } else {
            $filename = $dokter->foto;
        }

        $user = User::findOrFail($dokter->user_id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->foto = $filename;
        $user->save();

        $dokter->nama = $request->nama;
        $dokter->email = $request->email;
        $dokter->foto = $filename;
        $dokter->save();
    }
}
