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
}
