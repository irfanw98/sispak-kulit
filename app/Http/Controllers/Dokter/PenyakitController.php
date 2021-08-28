<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use App\Http\Requests\Dokter\Penyakit\StoreRequest;
use DataTables;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index(Request $request)
    {
        $penyakits = Penyakit::orderBy('nama', 'asc')->get();

        if($request->ajax()) {
            return DataTables::of($penyakits) 
                -> addColumn('Aksi', function($data) {
                    return '
                        <a href="" class="btn btn-info ubahGejala" role="button" ubah-kode="' . $data->kode_gejala . '"><i class="fas fa-edit"></i> UBAH</a>
                        <a href="" class="btn btn-danger hapusGejala" role="button" delete-kode="' . $data->kode_gejala . '" namaGejala="' . $data->nama . '"><i class="fa fa-trash"></i> HAPUS</a>
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
