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
        if($request->input('gejala') != null) {

            $diagnosa = $this->basispengetahuan($request->input('gejala'));
            $penyakit = Penyakit::where('kode_penyakit', $diagnosa)->first();
            $gejalas = Aturan::with('gejala')->where('penyakit_kode', $penyakit->kode_penyakit)->get();
            $user = User::where('id', Auth::user()->id)->first();

            $konsultasi = new Konsultasi;
            $konsultasi->user_id = $user->id;
            $konsultasi->kode_penyakit = $penyakit->kode_penyakit;
            $konsultasi->save();

            return view('user.diagnosa.hasil', compact('penyakit', 'gejalas', 'user'));
        } else {
            return redirect('konsultasi');
        }  

    }

    private function basispengetahuan($gejala)
    {   
        $role['P001'] = 0;
        $role['P002'] = 0;
    
        for ($i=0; $i < count($gejala); $i++) {
           if(
                $gejala[$i] == "G001" || $gejala[$i] == "G003"
                || $gejala[$i] == "G005"
           ) {
               $role['P001'] = $role['P001'] + 1 ;
           }

           if(
               $gejala[$i] == "G002" || $gejala[$i] == "G003" || $gejala[$i] == "G004" || $gejala[$i] == "G005"
           ) {
               $role['P002'] = $role['P002'] + 1 ;
           }

        $data = $role;
        asort($data);
        foreach ($data as $x => $x_value) {
            $hasil = $x;
        }

        return $hasil;
        }
        
    }
}
