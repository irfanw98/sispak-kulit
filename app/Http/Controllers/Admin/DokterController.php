<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;
use App\Models\User;
use App\Models\Dokter;
use App\Http\Requests\Admin\StoreDokterRequest;
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
                    <a href="" class="btn btn-success dokterDetail" role="button" detail-kode="' . $data->kode_dokter . '"><i class="fas fa-eye"></i> DETAIL</a>
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

    public function create()
    {
        $kode = Dokter::kode();

        return view('dokter.create', compact('kode'));
    }

    public function store(StoreDokterRequest $request)
    {
        //Insert Users
        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('dokter123');
        $user->remember_token = Str::random(60);
        $user->assignRole('dokter');
        $user->save();

        //Insert Dokter
        $file = $request->file('foto');
        $extension = $file->getClientOriginalExtension();
        $filename = base64_encode(time()) . '.' . $extension;
        $file->move('storage/dokter', $filename);
        $file->foto = $filename;

        $dokter = new Dokter;
        $dokter->kode_dokter = $request->kode;
        $dokter->user_id = $user->id;
        $dokter->nama = $request->nama;
        $dokter->username = $request->username;
        $dokter->email = $request->email;
        $dokter->foto = $filename;
        $dokter->save();

       return redirect('akun-dokter');
    }
    
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

    public function destroy($id)
    {
        $user = Dokter::findOrFail($id)->user;
        $user->delete();
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        
        return redirect('akun-dokter');
    }
}
