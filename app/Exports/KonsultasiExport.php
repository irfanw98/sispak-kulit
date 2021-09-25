<?php

namespace App\Exports;

use App\Models\Konsultasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KonsultasiExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Konsultasi::all();
    }

    public function map($konsultasi): array
    {
        return [
            $konsultasi->created_at,
            $konsultasi->user->nama,
            $konsultasi->penyakit->nama
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'Penyakit'
        ];
    }
}
