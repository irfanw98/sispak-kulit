<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::whereHas("roles", function($q){
            $q->where("name", "user"); 
        })->get();

        if ($request->ajax()) {
             return Datatables::of($users)
            -> addColumn('Aksi', function($data) {
                return '
                    <a href="" class="btn btn-danger userDelete" role="button" delete-id="' . $data->id . '" userNama="' . $data->nama . '"><i class="fa fa-trash"></i> HAPUS</a>
                ';
            })
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->removeColumn('id')
            ->make(true);
        }
        
        return view('user.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('akun-user');
    }

    public function sampah()
    {
        $users = User::whereHas("roles", function($q){
            $q->where("name", "user"); 
        })
        ->onlyTrashed()
        ->get();

        return view('user.sampah', compact('users'));
    }

    public function pulihkan($id = null)
    {
        if ($id != null) {
            User::where('id', $id)
                    ->onlyTrashed()
                    ->restore();
        } else {
            User::whereHas("roles", function($q){
                $q->where("name", "user"); 
            })
            ->onlyTrashed()
            ->restore();
        }

        return redirect('/akun-user/sampah');
    }

    public function hapus($id = null) 
    {
        if ($id != null) {
            $users = User::where('id', $id)
                                    ->onlyTrashed()
                                    ->first();
            $users->removeRole('user');
            $users->forceDelete();
        } else {
            $users =  User::whereHas("roles", function($q){
                                $q->where("name", "user"); 
                            })
                            ->onlyTrashed()
                            ->get();
                
            foreach ($users as $key => $user) {
                $user->removeRole("user");
                $user->forceDelete();
            }
        }
    }
}
