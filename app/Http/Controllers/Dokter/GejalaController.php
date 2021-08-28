<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use DataTables;
use App\Http\Requests\Dokter\Gejala\StoreRequest;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index(Request $request)
    {
        $gejalas = Gejala::orderBy('kode_gejala', 'asc')->get();

        if($request->ajax()) {
            return Datatables::of($gejalas) 
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
            return view('dokter.gejala.index');
    }

    public function create()
    {
        $kode = Gejala::kode();

        return view('dokter.gejala.create', compact('kode'));
    }

    public function store(StoreRequest $request)
    {
        Gejala::create([
            'kode_gejala' => $request->kode,
            'nama' => $request->nama
        ]);

        return redirect('gejala');
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
