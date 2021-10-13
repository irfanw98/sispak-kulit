<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{
    Konsultasi,
    User,
    Aturan,
    Gejala,
    Penyakit
};

class KonsultasiController extends Controller
{
    public function index()
    {
        $gejalas = Gejala::orderBy('kode_gejala', 'asc')
                            ->filter(request(['pencarian']))
                            ->paginate(8)
                            ->withQueryString();

        return view('user.konsultasi.index', compact('gejalas'));
    }

    public function store(Request $request)
    {
        if($request->input('gejala') != null) {

            $diagnosa = $this->basispengetahuan($request->input('gejala'));
            $penyakit = Penyakit::where('kode_penyakit', $diagnosa)->first();

            if($penyakit != null) {
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

        } else {
            return redirect('konsultasi');
        }  

    }

    private function basispengetahuan($gejala)
    {   
        $role['P000'] = 0;
        $role['P001'] = 0;
        $role['P002'] = 0;
        $role['P003'] = 0;
        $role['P004'] = 0;
        $role['P005'] = 0;

        if(
            $gejala == ["G004","G005","G006","G007"]
        ) {
            $role['P001'] = $role['P001'] + 1;
        } elseif(
            $gejala == ["G001","G002","G005"]
        ) {
            $role['P002'] = $role['P002'] + 1;
        } elseif(
            $gejala == ["G008","G009","G010"]
        ) {
            $role['P003'] = $role['P003'] + 1;
        } elseif(
            $gejala == ["G002","G003","G005","G012"]
        ) {
            $role['P004'] = $role['P004'] + 1;
        } elseif(
            $gejala == ["G012"]
        ) {
            $role['P005'] = $role['P005'] + 1;
        } else {
            $role['P000'] =  $role['P000'] + 1;
        }

        $data = $role;
        asort($data);
        foreach ($data as $x => $x_value) {
            $hasil = $x;
        }

        return $hasil;
    }
}
