<?php
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Admin,
    Dokter,
    User,
    Gejala,
    penyakit,
    Konsultasi
};


function jumlahAdmin()
{
    return Admin::count();
}

function jumlahDokter()
{
    return Dokter::count();
}

function jumlahUser()
{
    return User::whereHas("roles", function($q){
                $q->where("name", "user"); 
            })->count();
}

function jumlahGejala()
{
    return Gejala::count();
}

function jumlahPenyakit()
{
    return Penyakit::count();
}

function jumlahKonsultasi()
{
    return Konsultasi::count();
}

function jumlahKonsultasiId()
{
    return Konsultasi::where('user_id', Auth::user()->id)->count();
}

function getUserFoto()
{
    $user = User::where('id', Auth::user()->id)->first();
    
    if(!$user->foto){
        return asset('image/profile-user.png');
    } else {
        return asset('storage/user/' . $user->foto);
    }
}