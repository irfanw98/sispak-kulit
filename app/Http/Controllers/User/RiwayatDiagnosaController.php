<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Konsultasi;
use App\Models\Aturan;
use PDF;

class RiwayatDiagnosaController extends Controller
{
    public function index(Request $request)
    {
        $diagnosa = Konsultasi::with(['user', 'penyakit'])
                                ->where('user_id', Auth::user()->id)
                                ->latest()
                                ->get();

        if($request->ajax()){
            return DataTables::of($diagnosa)
                ->addColumn('User', function($data){
                    return $data->user->nama;
                }) 
                ->addColumn('Penyakit', function($data){
                    return $data->penyakit->nama;
                })
                -> addColumn('Aksi', function($data) {
                    return '
                        <a href="" class="btn btn-success diagnosaDetail" role="button" detail-diagnosa="' . $data->id . '"><i class="fas fa-eye"></i> DETAIL</a>
                    ';
                })
                ->rawColumns(['Aksi', 'User', 'Penyakit'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }

        return view('user.diagnosa.riwayat', compact('diagnosa'));
    }

    public function show($id)
    {
        $diagnosa = Konsultasi::with('penyakit')->findOrFail($id);
        $gejalas = Aturan::with('gejala')
                        ->where('penyakit_kode', $diagnosa->kode_penyakit)
                        ->get();

        return view('user.diagnosa.detail', compact('diagnosa', 'gejalas'));
    }

    public function exportPdf()
    {
        $diagnosas = Konsultasi::with(['user','penyakit'])->latest()->get();
        $pdf = PDF::loadView('user.diagnosa.riwayatpdf', compact('diagnosas'));
        return $pdf->download('riwayat.pdf');
    }

    public function cetakById($id)
    {
        $diagnosas = Konsultasi::with(['user', 'penyakit'])->where('id', $id)->get();

        return view('user.diagnosa.riwayatcetak', compact('diagnosas'));
    }

    public function pdfById($id)
    {
        $diagnosas = Konsultasi::with(['user', 'penyakit'])->where('id', $id)->get();
        $pdf = PDF::loadView('user.diagnosa.unduhpdf', compact('diagnosas'));

        return $pdf->download('riwayat-diagnosa.pdf');
    }
}
