<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Http\Requests\Dokter\Gejala\{
    StoreRequest,
    UpdateRequest,
};


class GejalaController extends Controller
{
    public function index(Request $request)
    {
        $gejalas = Gejala::orderBy('kode_gejala', 'asc')->get();

        if($request->ajax()) {
            return Datatables::of($gejalas) 
            ->addColumn('Cek', function($data) {
                $cek = '<input type="checkbox"  class="ceks"  kode-gejala="' . $data->kode_gejala . '">';
                return $cek;
            })
            -> addColumn('Aksi', function($data) {
                return '
                    <a href="" class="btn btn-info ubahGejala" role="button" ubah-kode="' . $data->kode_gejala . '"><i class="fas fa-edit"></i> UBAH</a>
                    <a href="" class="btn btn-danger hapusGejala" role="button" delete-kode="' . $data->kode_gejala . '" namaGejala="' . $data->nama . '"><i class="fa fa-trash"></i> HAPUS</a>
                ';
            })
            ->rawColumns(['Aksi', 'Cek'])
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
        $gejala = new Gejala;
        $gejala->kode_gejala = $request->kode;
        $gejala->nama = $request->nama;
        $gejala->save();

        return redirect('gejala');
    }

    public function edit($id)
    {
        $gejala = Gejala::findOrFail($id);
        
        return view('dokter.gejala.edit', compact('gejala'));
    }
    public function update(UpdateRequest $request, $id)
    {
        $gejala = Gejala::findOrFail($id);
        $gejala->nama = $request->nama;
        $gejala->save();
        
        return redirect('gejala');
    }

    public function destroy($id)
    {
        $gejala = Gejala::findOrFail($id);
        $gejala->delete();

        return redirect('gejala');
    }

    public function hapus(Request $request)
    {
        if ($request->multi != null) {
            $datas = $request->data;
            foreach ($datas as $key) {
                $data = Gejala::findOrFail($key);
                $data->delete();
            }

            return redirect('gejala');
        }
    }
}
