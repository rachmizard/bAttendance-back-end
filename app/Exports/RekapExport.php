<?php

namespace App\Exports;
use App\Karyawan;
use App\Http\Resources\RekapResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RekapResource::collection(Karyawan::all());
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'Jumlah Hadir',
            'Jumlah Izin',
            'Jumlah Sakit',
            'Jumlah Alfa',
            'Total Lembur',
        ];
    }
}
