<?php
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

