<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index() 
    {
        $admin = Admin::all()->count();
        $dokter = Dokter::all()->count();
        $user =   User::whereHas("roles", function($q){
                            $q->where("name", "user"); 
                        })->count();

        return view('admin.dashboard', compact('admin', 'dokter', 'user'));
    }
}
