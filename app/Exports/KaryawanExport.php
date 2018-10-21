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
        return Karyawan::select('id', 'nama', 'divisi', 'jenis_kelamin', 'nik', 'status')->get();
    }


    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Divisi',
            'Jenis Kelamin',
            'Nik',
            'Status'
        ];
    }
}
