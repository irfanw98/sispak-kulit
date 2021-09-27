<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Models\{
    Admin,
    Dokter,
    User,
    Konsultasi
};

class DashboardAdminController extends Controller
{
    public function index() 
    {
        $admin = Admin::all()->count();
        $dokter = Dokter::all()->count();
        $jml_konsultasi = Konsultasi::all()->count();
        $user =   User::whereHas("roles", function($q){
                            $q->where("name", "user"); 
                        })->count();

        // $konsultasis = Konsultasi::groupBy(\DB::raw('MONTH(created_at)'))->get();
        $konsultasis= Konsultasi::select(
                        \DB::raw('count(id) as count'),
                        \DB::raw('DATE_FORMAT(created_at, "%M") as months')
                        )
                        ->groupBy('months')
                        ->get();

        $result_bulan = [];
        $result_jml = [];
        foreach ($konsultasis as $konsultasi) {
            $result_bulan[] = $konsultasi['months'];
            $result_jml[] = $konsultasi['count'];
        }

        $bulan = json_encode($result_bulan);
        $jumlah_konsultasi = json_encode($result_jml);

        return view('admin.dashboard', compact(
            'admin', 
            'dokter',
            'jml_konsultasi', 
            'user', 
            'bulan', 
            'jumlah_konsultasi'
        ));
    }
}
