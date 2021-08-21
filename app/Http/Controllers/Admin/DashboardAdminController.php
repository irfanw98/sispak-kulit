<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index() 
    {
        $admin = Admin::all()->count();
        $dokter = Dokter::all()->count();

        return view('admin.dashboard', compact('admin', 'dokter'));
    }
}
