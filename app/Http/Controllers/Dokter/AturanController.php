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
        $penyakits = Penyakit::with(['gejala'])->orderBy('kode_penyakit', 'asc')->get();
        // $aturans = Aturan::with(['penyakit', 'gejala'])->groupBy('penyakit_kode')->get();
        // $aturans = Aturan::with(['penyakit', 'gejala'])->orderBy('penyakit_kode')->get()->groupBy('penyakit_kode');

        if($request->ajax()) {
            return DataTables::of($penyakits)
            -> addColumn('penyakit', function($row) {
                return $row->gejala;
            })
            -> addColumn('Aksi', function($data) {
                    return '
                        <a href="" class="btn btn-success aturanDetail" role="button" ><i class="fas fa-eye"></i> DETAIL</a>
                        <a href="" class="btn btn-info ubahAturan" role="button" ubah-kode="' . $data->kode_penyakit  . '"><i class="fas fa-edit"></i> UBAH</a>
                        <a href="" class="btn btn-danger hapusAturan" role="button" ><i class="fa fa-trash"></i> HAPUS</a>
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
        //
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
