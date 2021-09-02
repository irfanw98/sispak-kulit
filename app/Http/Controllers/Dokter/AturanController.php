<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Aturan;
use App\Models\Penyakit;
use App\Models\Gejala;
use DataTables;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    public function index(Request $request) 
    {
        $penyakits = Penyakit::with(['gejala'])->orderBy('kode_penyakit', 'ASC')->get();

        if($request->ajax()) {
            return DataTables::of($penyakits)
            -> addColumn('Aksi', function($data) {
                    return '
                        <a href="" class="btn btn-success aturanDetail" role="button" detail-kode="' . $data->kode_penyakit . '"><i class="fas fa-eye"></i> DETAIL</a>
                        <a href="" class="btn btn-info ubahAturan" role="button" ubah-kode="' . $data->kode_penyakit . '"><i class="fas fa-edit"></i> UBAH</a>
                        <a href="" class="btn btn-danger hapusAturan" role="button" delete-kode="' . $data->kode_penyakit . '" namaPenyakit="' . $data->nama . '"><i class="fa fa-trash"></i> HAPUS</a>
                    ';
                })
                ->rawColumns(['Aksi'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
            }
      
        return view('dokter.aturan.index');
    }

    public function create()
    {
        $penyakits = Penyakit::orderBy('kode_penyakit', 'asc')->get();
        $gejalas   = Gejala::orderBy('kode_gejala', 'asc')->get();
        
        return view('dokter.aturan.create', compact('penyakits', 'gejalas'));
    }

    public function store(Request $request)
    {
        dd($request);
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
