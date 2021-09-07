<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\{
    Penyakit,
    Gejala
};

class AturanController extends Controller
{
    public function index(Request $request) 
    {
        $penyakits = Penyakit::with(['gejala'])->orderBy('kode_penyakit', 'asc')->get();

        if($request->ajax()) {
            return DataTables::of($penyakits)
            -> addColumn('penyakit', function($row) {
                return $row->gejala;
            })
            -> addColumn('Aksi', function($data) {
                return '
                    <a href="" class="btn btn-success detailAturan" role="button" detail-kode="' . $data->kode_penyakit  . '"><i class="fas fa-eye"></i> DETAIL</a>
                    <a href="" class="btn btn-info ubahAturan" role="button" ubah-kode="' . $data->kode_penyakit  . '"><i class="fas fa-edit"></i> UBAH</a>
                ';
            })
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->removeColumn('id')
            ->make(true);
        }
      
        return view('dokter.aturan.index');
    }

    public function show($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        
        return view('dokter.aturan.detail', compact('penyakit'));
    }

    public function edit($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        $gejalas = Gejala::orderBy('kode_gejala', 'asc')->get();

        return view('dokter.aturan.edit', compact('penyakit','gejalas'));
    }
    public function update(Request $request, $id)
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->gejala()->sync($request->gejala);

        return redirect('aturan');
    }
}
