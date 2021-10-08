<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


class TentangController extends Controller
{
    public function index()
    {
        return view('user.tentang.index');   
    }
}
