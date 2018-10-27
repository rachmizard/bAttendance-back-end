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
      $validator = Karyawan::where('id', $row[0])->count();
      if ($validator) {
        Karyawan::where('id', $row[0])->update([
             'id' => $row[0],
             'nik'     => $row[1],
             'nama'    => $row[2],
             'divisi' =>  $row[3],
             'jenis_kelamin' => $row[4],
             'status' => $row[5]
          ]);
      }else if($row[0] == null){
        $validator2 = Karyawan::where([
            'nik' => $row[1],
            'nama' => $row[2],
            'divisi' => $row[3],
            'jenis_kelamin' => $row[4],
            'status' => $row[5]
        ])->get();

        if (count($validator2)) {
            foreach ($validator2 as $replace) {
                Karyawan::where('id', $replace->id)->update([
                     'nik'     => Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('is'),
                     'nama'    => $row[2],
                     'divisi' =>  $row[3],
                     'jenis_kelamin' => $row[4],
                     'status' => $row[5]
                    ]);
            }
        }else{
            return new Karyawan([
                 'nik'     => Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('is'),
                 'nama'    => $row[2],
                 'divisi' =>  $row[3],
                 'jenis_kelamin' => $row[4],
                 'status' => $row[5]
              ]);
        }
      }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
