<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Konsultasi,
    User,
    Aturan,
    Gejala,
    Penyakit
};
use Auth;

class KonsultasiController extends Controller
{
    public function index()
    {
        $gejalas = Gejala::orderBy('nama', 'asc')->get();

        return view('user.konsultasi.index', compact('gejalas'));
    }

    public function store(Request $request)
    {
        if($request->gejala == null) {
            return redirect('konsultasi');
        } else {

            $gejala = $this->basispengetahuan($request->gejala);

            $konsultasi = new Konsultasi;
            $konsultasi->user_id = Auth::user()->id;
            // dd($konsultasi);
        }  

    }

    private function basispengetahuan($gejala)
    {
        dd($gejala);
        // $aturans = Aturan::groupBy('gejala_kode')->get();

        // $gejala_kode = [];
        
        // foreach ($aturans as $aturan) {
        //     $kode = $aturan->gejala_kode;
        //     array_push($gejala_kode, $kode);
        // }

        
        // dd($gejala_kode);

        // if($gejala == "G001") {
        //     dd('OKE');
        // } else {
        //     dd('Fail');
        // }

        // $role['P001'] = 0;
        // $role['P002'] = 0;
    
        // for ($i=0; $i < count($gejala); $i++) {
        //     dd($gejala[$i]); 
        //    if(
        //         $gejala[$i] == "G001" && $gejala[$i] == "G003"
        //         && $gejala[$i] == "G005"
        //    ) {
        //        $role['P001'] = $role['P001'] + 1 ;
        //        dd($role['P001']);
        //    }
        // }

        
    }
}
