<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;

class DashboardAdminController extends Controller
{
    public function index() 
    {
        $konsultasis = Konsultasi::select(
                        \DB::raw('count(id) as count'),
                        \DB::raw('DATE_FORMAT(created_at, "%M") as months')
                        )
                        ->groupBy('months')
                        ->orderBy('created_at', 'asc')
                        ->get();

        $result_bulan = [];
        $result_jml = [];
        foreach ($konsultasis as $konsultasi) {
            $result_bulan[] = $konsultasi['months'];
            $result_jml[] = $konsultasi['count'];
        }

        $bulan = json_encode($result_bulan);
        $jumlah_konsultasi = json_encode($result_jml);

        return view('admin.dashboard', compact('bulan','jumlah_konsultasi'));
    }
}
