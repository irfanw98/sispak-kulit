<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KonsultasiExport;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Konsultasi;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporan = Konsultasi::with(['user', 'penyakit'])->latest()->get();
     
        if($request->ajax()){
            return DataTables::of($laporan)
                ->addColumn('User', function($data){
                        return $data->user->nama;
                    }) 
                ->addColumn('Penyakit', function($data){
                    return $data->penyakit->nama;
                })
                -> addColumn('Aksi', function($data) {
                    return '
                        <a href="" class="btn btn-danger diagnosaDelete" role="button" delete-konsultasi="' . $data->id . '" user-konsultasi="'. $data->user->nama .'"><i class="fas fa-trash"></i> HAPUS</a>
                    ';
                })
                ->rawColumns(['Aksi', 'User', 'Penyakit'])
                ->addIndexColumn()
                ->removeColumn('id')
                ->make(true);
        }

        return view('admin.laporan.index', compact('laporan'));
    }
    
    public function destroy($id)
    {
        $laporan = Konsultasi::findOrFail($id);
        $laporan->delete();

        return redirect('laporan-konsultasi');
    }

    public function sampah(Request $request)
    {
        $laporan = Konsultasi::with(['user', 'penyakit'])->onlyTrashed()->get();

        if($request->ajax()){
            return DataTables::of($laporan)
            ->addColumn('User', function($data) {
                return $data->user->nama;
            })
            ->addColumn('Penyakit', function($data) {
                return $data->penyakit->nama;
            })
            -> addColumn('Aksi', function($data) {
                return '
                    <a href="" class="btn btn-success konsultasiPulihkan" role="buttton" pulihkan-id="'. $data->id .'" user-konsultasi="'. $data->user->nama .'"><i class="fa fa-undo-alt"></i> PULIHKAN</a>

                    <a href="" class="btn btn-danger konsultasiDelete" role="button" delete-konsultasi="' . $data->id . '" user-konsultasi="'. $data->user->nama .'"><i class="fas fa-trash"></i> HAPUS</a>
                ';
            })
            ->rawColumns(['Aksi', 'User', 'Penyakit'])
            ->addIndexColumn()
            ->removeColumn('id')
            ->make(true);
        }

        return view('admin.laporan.sampah');
    }

    public function hapus($id = null)
    {
        if($id != null) {
            $laporan = Konsultasi::where('id', $id)
                                ->onlyTrashed()
                                ->first();
            $laporan->forceDelete();
        } else {
            $laporans = Konsultasi::onlyTrashed()->get();
            
            foreach ($laporans as $laporan) {
                $laporan->forceDelete();
            }
        }
    }

    public function pulihkan($id = null)
    {
        if($id != null){
            Konsultasi::where('id', $id)
                        ->onlyTrashed()
                        ->restore();
        } else{
            Konsultasi::onlyTrashed()->restore();
        }
    }

    public function cetak()
    {
        $laporans = Konsultasi::with(['user', 'penyakit'])->latest()->get();

        return view('admin.laporan.cetak', compact('laporans'));
    }

    public function cetakTanggal($tglawal, $tglakhir)
    {
        $tanggal_awal = Carbon::parse($tglawal)
                                ->startOfDay()
                                ->toDateTimeString();
        $tanggal_akhir = Carbon::parse($tglakhir)
                                ->endOfDay()
                                ->toDateTimeString();
        
        if($tanggal_awal <= $tanggal_akhir){
            
            $laporans = Konsultasi::with(['user', 'penyakit'])
                                    ->whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
                                    ->latest()
                                    ->get();

            return view('admin.laporan.cetak-pertanggal', compact('laporans'));

        } else {
            return "gagal!";
        }
    }

    public function exportPdf()
    {
        $laporans = Konsultasi::with(['user', 'penyakit'])
                                ->latest()
                                ->get();
        $pdf =  PDF::loadView('admin.laporan.export-pdf', compact('laporans')); 
        return $pdf->download('laporan-konsultasi.pdf');   
    }

    public function exportExcel()
    {
         return Excel::download(new KonsultasiExport, 'laporan-konsultasi.xlsx');
    }
}
