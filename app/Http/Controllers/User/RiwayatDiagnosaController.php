<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konsultasi;
use DataTables;

class RiwayatDiagnosaController extends Controller
{
    public function index(Request $request)
    {
        $diagnosa = Konsultasi::with(['user', 'penyakit'])->latest()->get();

        if($request->ajax()){
            return DataTables::of($diagnosa)
                ->addColumn('user', function($data){
                    return $data->user->nama;
                }) 
                ->addColumn('penyakit', function($data){
                    return $data->penyakit->nama;
                })
                -> addColumn('Aksi', function($data) {
                    return '
                        <a href="" class="btn btn-success diagnosaDetail" role="button" detail-diagnosa="' . $data->id . '"><i class="fas fa-eye"></i> DETAIL</a>
                    ';
                })
                ->rawColumns(['Aksi', 'user', 'penyakit'])
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

}
