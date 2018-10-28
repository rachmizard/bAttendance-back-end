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
             'jabatan'    => $row[3],
             'divisi' =>  $row[4],
             'jenis_kelamin' => $row[5],
             'status' => $row[6]
          ]);
      }else if($row[0] == null){
        $validator2 = Karyawan::where([
            'nik' => $row[1],
            'nama' => $row[2],
            'jabatan' => $row[3],
            'divisi' => $row[4],
            'jenis_kelamin' => $row[5],
            'status' => $row[6]
        ])->get();

        if (count($validator2)) {
            foreach ($validator2 as $replace) {
                Karyawan::where('id', $replace->id)->update([
                     'nik'     => Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('i') . Carbon::now()->format('s'),
                     'nama'    => $row[2],
                     'jabatan' =>  $row[3],
                     'divisi' =>  $row[4],
                     'jenis_kelamin' => $row[5],
                     'status' => $row[6]
                    ]);
            }
        }else{
            return new Karyawan([
                 'nik'     => Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('i') . Carbon::now()->format('s'),,
                 'nama'    => $row[2],
                 'jabatan' =>  $row[3],
                 'divisi' =>  $row[4],
                 'jenis_kelamin' => $row[5],
                 'status' => $row[6]
              ]);
        }
      }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
