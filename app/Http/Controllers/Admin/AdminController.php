<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use App\Models\Admin;
use App\Models\User;
use App\Http\Requests\Admin\StoreAdminRequest;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = Admin::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($admins)
            -> addColumn('Aksi', function($data) {
                return '
                     <a href="" class="btn btn-danger adminDelete" role="button" delete-id="' . $data->id . '" adminNama="' . $data->nama . '"><i class="fa fa-trash"></i> HAPUS</a>
                ';
            })
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->removeColumn('id')
            ->make(true);
        }
        return view('admin.index');
    }

    public function store(StoreAdminRequest $request)
    {
        //Insert users
        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('admin123');
        $user->remember_token = Str::random(60);
        $user->assignRole('admin');
        $user->save();

        //Insert Admin
        $admin = new Admin;
        $admin->user_id = $user->id;
        $admin->nama = $request->nama;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->save();

        return redirect('akun-admin');
    }

    public function destroy($id)
    {
        $user = Admin::find($id)->user;
        $user->delete();
        $admin = Admin::findOrFail($id); 
        $admin->delete();

        return redirect('akun-admin');
    }

    public function sampah()
    {
        $users = User::whereHas("roles", function($q){
            $q->where("name", "admin"); 
        })->onlyTrashed()->get();

        return view('admin.sampah', compact('users'));
    }

    public function pulihkan($id = null) 
    {
        if ($id != null) {
           User::where('id', $id)
                    ->onlyTrashed()
                    ->restore();

            Admin::where('user_id', $id)
                        ->onlyTrashed()
                        ->restore();
        } else {
            User::onlyTrashed()->restore();
            Admin::onlyTrashed()->restore();
        }

        return redirect('/akun-admin/sampah');
    }

    public function hapus($id = null)
    {
        if ($id != null) {
            $user = User::where('id', $id)
                                ->onlyTrashed()->first();
            $user->removeRole('admin');
            $user->forceDelete();
        } else {
            $users = User::onlyTrashed()->get();

            foreach ($users as $key => $user) {
                $user->removeRole('admin');
                $user->forceDelete();
            }
        }
    }
}
