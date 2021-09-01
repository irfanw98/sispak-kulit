<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use App\Http\Requests\Dokter\Penyakit\StoreRequest;
use App\Http\Requests\Dokter\Penyakit\UpdateRequest;
use DataTables;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index(Request $request)
    {
        $penyakits = Penyakit::orderBy('kode_penyakit', 'asc')->get();

        if($request->ajax()) {
            return DataTables::of($penyakits) 
                -> addColumn('Aksi', function($data) {
                    return '
                        <a href="" class="btn btn-success penyakitDetail" role="button" detail-kode="' . $data->kode_penyakit . '"><i class="fas fa-eye"></i> DETAIL</a>
                        <a href="" class="btn btn-info ubahPenyakit" role="button" ubah-kode="' . $data->kode_penyakit . '"><i class="fas fa-edit"></i> UBAH</a>
                        <a href="" class="btn btn-danger hapusPenyakit" role="button" delete-kode="' . $data->kode_penyakit . '" namaPenyakit="' . $data->nama . '"><i class="fa fa-trash"></i> HAPUS</a>
                    ';
                })
                ->rawColumns(['Aksi'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
            }
        
        return view('dokter.penyakit.index', compact('penyakits'));
    }

    public function create()
    {
        $kode = Penyakit::kode();
        
        return view('dokter.penyakit.create', compact('kode'));
    }

    public function store(StoreRequest $request)
    {
        $penyakit = new Penyakit;
        $penyakit->kode_penyakit = $request->kode;
        $penyakit->nama = $request->nama;
        $penyakit->deskripsi = strip_tags($request->deskripsi);
        $penyakit->solusi = strip_tags($request->solusi);
        $penyakit->save();

        return redirect('penyakit');
    }

    public function show($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        
        return view('dokter.penyakit.detail', compact('penyakit'));
    }

    public function edit($id)
    {
        $penyakit = Penyakit::FindOrFail($id);
        
        return view('dokter.penyakit.edit', compact('penyakit'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $penyakit = Penyakit::FindOrFail($id);
        $penyakit->nama = $request->nama;
        $penyakit->deskripsi = $request->deskripsi;
        $penyakit->solusi = $request->solusi;
        $penyakit->save();

        return redirect('penyakit');
    }

    public function destroy($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->delete();

        return redirect('penyakit');
    }
}
