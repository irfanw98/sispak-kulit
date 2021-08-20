<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index() 
    {
        $admin = Admin::all()->count();

        return view('admin.dashboard', compact('admin'));
    }
}
