<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konsultasi;

class RiwayatDiagnosaController extends Controller
{
    public function index()
    {
        return view('user.diagnosa.riwayat');
    }

    public function show($id)
    {
        //
    }

}
