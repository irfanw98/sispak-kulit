<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konsultasi;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporan = Konsultasi::with(['user', 'penyakit'])->latest()->get();
     
        if($request->ajax()){
            return DataTables::of($laporan)
                ->addColumn('User', function($data){
                        return $data->user->nama;
                    }) 
                ->addColumn('Penyakit', function($data){
                    return $data->penyakit->nama;
                })
                -> addColumn('Aksi', function($data) {
                    return '
                        <a href="" class="btn btn-danger diagnosaDelete" role="button" delete-konsultasi="' . $data->id . '" user-konsultasi="'. $data->user->nama .'"><i class="fas fa-trash"></i> HAPUS</a>
                    ';
                })
                ->rawColumns(['Aksi', 'User', 'Penyakit'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }


        return view('admin.laporan.index');
    }
    
    public function destroy($id)
    {
        $laporan = Konsultasi::findOrFail($id);
        $laporan->delete();

        return redirect('laporan-konsultasi');
    }

    public function sampah(Request $request)
    {
        $laporan = Konsultasi::with(['user', 'penyakit'])->onlyTrashed()->get();

        if($request->ajax()){
            return DataTables::of($laporan)
            ->addColumn('User', function($data) {
                return $data->user->nama;
            })
            ->addColumn('Penyakit', function($data) {
                return $data->penyakit->nama;
            })
            -> addColumn('Aksi', function($data) {
                return '
                    <a href="" class="btn btn-danger konsultasiDelete" role="button" delete-konsultasi="' . $data->id . '" user-konsultasi="'. $data->user->nama .'"><i class="fas fa-trash"></i> HAPUS</a>
                ';
            })
            ->rawColumns(['Aksi', 'User', 'Penyakit'])
            ->addIndexColumn()
            ->removeColumn('id')
            ->make(true);
        }

        return view('admin.laporan.sampah');
    }

    public function hapus($id = null)
    {
        if($id != null) {
            $laporan = Konsultasi::where('id', $id)
                        ->onlyTrashed()
                        ->first();
            $laporan->forceDelete();
        } else {
            $laporans = Konsultasi::onlyTrashed()->get();
            
            foreach ($laporans as $laporan) {
                $laporan->forceDelete();
            }
        }
    }
}
