<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Dokter;
use App\Models\User;
use App\Models\Konsultasi;
use Illuminate\Support\Carbon;

class DashboardAdminController extends Controller
{
    public function index() 
    {
        $admin = Admin::all()->count();
        $dokter = Dokter::all()->count();
        $user =   User::whereHas("roles", function($q){
                            $q->where("name", "user"); 
                        })->count();

        $konsultasis = Konsultasi::select([
            \DB::raw('count(id) as `count`'), 
            \DB::raw('DATE(created_at) as month')
        ])->groupBy('month')
        ->where('created_at', '>=', Carbon::now()->subMonths())
        ->get();

        $result_bulan = [];
        $result_jml = [];
        foreach ($konsultasis as $konsultasi) {
            $result_bulan[] = Carbon::parse($konsultasi['mounth'])->format('M');
            $result_jml[] = $konsultasi['count'];
        }
            //    dd($result_bulan);

        $bulan = json_encode($result_bulan);
        $jumlah_konsultasi = json_encode($result_jml);

        return view('admin.dashboard', compact(
            'admin', 
            'dokter', 
            'user', 
            'bulan', 
            'jumlah_konsultasi'
        ));
    }
}
