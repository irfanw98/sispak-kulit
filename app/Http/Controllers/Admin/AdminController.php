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
        // $admins = DB::table('tb_admin')->get();
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
        //Insert table users
        $user = new User;
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('admin123');
        $user->remember_token = Str::random(60);
        $user->assignRole('admin');
        $user->save();

        //Insert table Admin
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
        $admin = Admin::find($id);
        $user = Admin::find($id)->user;
        $user->delete();
        $admin->delete();

        //  Admin::where('id', $id)->with('user')->delete();

        return redirect('akun-admin');
    }

    public function sampah()
    {
        $admins = Admin::onlyTrashed()->get();
        return view('admin.sampah', compact('admins'));
    }

    public function pulihkan($id = null) 
    {
        if ($id != null) {
            Admin::onlyTrashed()
                        ->where('id', $id)
                        ->restore();
        } else {
            Admin::onlyTrashed()->restore();
        }

        return redirect('/akun-admin/sampah');
    }

    public function hapus($id = null)
    {
        if ($id != null) {

            // $user = user::find($id);
            // $user->admins()->whereId($id);
            // dd($user);
                    
            // Admin::onlyTrashed()
            //             ->where('id', $id)
            //             ->forceDelete();
        } else {
            Admin::onlyTrashed()->forceDelete();
        }

        return redirect()->back();
    }
}
