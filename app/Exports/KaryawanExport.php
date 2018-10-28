<?php

namespace App\Exports;

use App\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;


class KaryawanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function collection()
    {
        return Karyawan::select('id', 'nik', 'nama', 'jabatan', 'divisi', 'jenis_kelamin', 'status')->get();
    }


    public function headings(): array
    {
        return [
            'ID',
            'Nik',
            'Nama',
            'Jabatan',
            'Divisi',
            'Jenis Kelamin',
            'Status'
        ];
    }
}
