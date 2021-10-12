<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Konsultasi;

class DashboardUserController extends Controller
{
    public function index() 
    {
        $konsultasis = Konsultasi::select(
                        \DB::raw('count(user_id) as count'),
                        \DB::raw('DATE_FORMAT(created_at, "%M") as months')
                        )
                        ->groupBy('months')
                        ->where('user_id', Auth::user()->id)
                        ->orderBy('created_at', 'asc')
                        ->get();

        $konsultasi_bulan = [];
        $konsultasi_jumlah = [];
        foreach ($konsultasis as $konsultasi) {
            $konsultasi_bulan[] = $konsultasi['months'];
            $konsultasi_jumlah[] = $konsultasi['count'];
        }
        
        $bulan = json_encode($konsultasi_bulan);
        $jumlah_konsultasi = json_encode($konsultasi_jumlah);

        return view('user.dashboard', compact('bulan', 'jumlah_konsultasi'));
    }
}
