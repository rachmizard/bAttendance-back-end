<?php

namespace App\Imports;

use App\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;

class KaryawanImport implements ToModel, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\
    */
    public function model(array $row)
    {
        return new Karyawan([
           'nik'     => Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('is'),
           'nama'    => $row['nama'],
           'divisi' =>  $row['divisi'],
           'jenis_kelamin' => $row['jenis_kelamin'],
           'status' => $row['status']
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
