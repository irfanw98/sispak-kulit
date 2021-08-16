<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\User;
use DataTables;

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
                     <a href="" class="btn btn-info adminEdit" id="" role="button" edit-id="' . $data->id . '"><i class="fa fa-edit"></i> UBAH</a>
                     <a href="" class="btn btn-danger adminEdelete" role="button" delete-id="' . $data->id . '"><i class="fa fa-trash"></i> HAPUS</a>
                ';
            })
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->removeColumn('id')
            ->make(true);
        }
        return view('admin.index');
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

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
