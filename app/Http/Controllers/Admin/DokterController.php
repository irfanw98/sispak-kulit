<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;
use App\Models\User;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $dokters = Dokter::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($dokters)
            -> addColumn('Aksi', function($data) {
                return '
                    <a href="#" class="btn btn-success dokterDetail" role="button" detail-kode="' . $data->kode_dokter . '"><i class="fas fa-eye"></i> DETAIL</a>
                    <a href="" class="btn btn-info dokterUbah" role="button" ubah-kode="' . $data->kode_dokter . '"><i class="fas fa-edit"></i> UBAH</a>
                     <a href="" class="btn btn-danger dokterDelete" role="button" delete-kode="' . $data->kode_dokter . '" dokterNama="' . $data->nama . '"><i class="fa fa-trash"></i> HAPUS</a>
                ';
            })
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->removeColumn('id')
            ->make(true);
        }
        return view('dokter.index', compact('dokters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokter = Dokter::findOrFail($id);
       
        return view('dokter.detail', compact('dokter'));
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
