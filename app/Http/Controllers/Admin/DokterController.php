<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{
    Dokter,
    User
};
use App\Http\Requests\Admin\{
    StoreDokterRequest,
    UpdateDokterRequest
};

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
        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('dokter123');
        $user->remember_token = Str::random(60);
        $user->assignRole('dokter');
        $user->save();

        if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $filename = base64_encode(time()) . '.' . $extension;
                $file->move('storage/dokter', $filename);
                $file->foto = $filename;
        } else {
            $filename = '';
        }

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

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);

        return view('dokter.edit', compact('dokter'));
    }

    public function update(UpdateDokterRequest $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = base64_encode(time()) . '.' . $extension;
            $file->move('storage/dokter', $filename);
            $oldFilename = $dokter->foto;
            $dokter->foto = $filename;
            Storage::disk('public')->delete("dokter/" . $oldFilename);
        } else {
            $filename = $dokter->foto;
        }

        $user = User::findOrFail($dokter->user_id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->save();

        $dokter->nama = $request->nama;
        $dokter->username = $request->username;
        $dokter->email = $request->email;
        $dokter->foto = $filename;
        $dokter->save();

        return redirect('akun-dokter');
    }

    public function destroy($id)
    {
        $user = Dokter::findOrFail($id)->user;
        $user->delete();
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        
        return redirect('akun-dokter');
    }

    public function sampah (Request $request)
    {
        $dokters = User::whereHas("roles", function($q){
            $q->where("name", "dokter"); 
        })
        ->onlyTrashed()
        ->get();

        if($request->ajax()) {
            return DataTables::of($dokters)
            -> addColumn('Aksi', function($data) {
            return '
                <a href="" class="btn btn-info dokterPulihkan" role="buttton" pulihkan-id="'. $data->id .'" pulihkanName ="'. $data->nama .'" ><i class="fa fa-undo-alt"></i> PULIHKAN</a>

                <a href="" class="btn  btn-danger deleteSampah" deleteId = "'. $data->id .'" deleteName ="'. $data->nama .'"><i class="fa fa-trash"></i> HAPUS</a>
            ';
            })
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->removeColumn('id')
            ->make(true);
        }

         return view('dokter.sampah', compact('dokters'));
    }

    public function pulihkan($id = null) 
    {
        if ($id != null) {
            User::where('id', $id)
                    ->onlyTrashed()
                    ->restore();

            Dokter::where('user_id', $id)
                        ->onlyTrashed()
                        ->restore();
        } else {
            User::whereHas("roles", function($q){
                $q->where("name", "dokter"); 
            })
            ->onlyTrashed()
            ->restore();

            Dokter::onlyTrashed()->restore();
        }

        return redirect('/akun-dokter/sampah');
    }

    public function hapus($id = null)
    {
        if($id != null) {
            $users = User::where('id', $id)
                        ->onlyTrashed()
                        ->first();
            $users->removeRole('dokter');
            $users->forceDelete();
        } else {
            $users =  User::whereHas("roles", function($q){
                                $q->where("name", "dokter"); 
                            })
                            ->onlyTrashed()
                            ->get();
                
            foreach ($users as $key => $user) {
                $user->removeRole("dokter");
                $user->forceDelete();
            }
        }
    }
}
