<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konsultasi;
use Yajra\DataTables\DataTables;
use PDF;
use Illuminate\Support\Facades\Auth;

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
        $diagnosa = Konsultasi::findOrFail($id);
        
        return view('user.diagnosa.detail', compact('diagnosa'));
    }

    public function exportPdf()
    {
        $diagnosas = Konsultasi::with(['user','penyakit'])->get();
        $pdf = PDF::loadView('user.diagnosa.riwayatpdf', compact('diagnosas'));
        return $pdf->download('riwayat.pdf');
    }

}
