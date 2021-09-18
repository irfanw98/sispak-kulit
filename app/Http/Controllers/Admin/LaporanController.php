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
                        <a href="" class="btn btn-danger diagnosaDelete" role="button" delete-user="' . $data->id . '" nama-user="'. $data->user->nama .'"><i class="fas fa-trash"></i> HAPUS</a>
                    ';
                })
                ->rawColumns(['Aksi', 'User', 'Penyakit'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }


        return view('admin.laporan.index');
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
