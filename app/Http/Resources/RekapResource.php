<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Absen;
use App\MasterRekap;

class RekapResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
          'id' => $this->id,
          'karyawan' => $this->karyawan->nama,
          'jml_hadir' => $this->countHadir(),
          'jml_izin' => $this->countIzin(),
          'jml_sakit' => $this->countSakit(),
          'jml_alfa' => $this->countAlfa()
        ];
    }

    public function countHadir()
    {
      return Absen::with('master_rekap')->where(['karyawan_id' => $this->karyawan->id, 'status' => 'keluar', 'created_at' => MasterRekap::find(1)->tanggal_aktif_rekap])->count();
    }

    public function countIzin()
    {
      return Absen::with('master_rekap')->where(['karyawan_id' => $this->karyawan->id, 'status' => 'izin', 'created_at' => MasterRekap::find(1)->tanggal_aktif_rekap])->count();
    }

    public function countSakit()
    {
      return Absen::with('master_rekap')->where(['karyawan_id' => $this->karyawan->id, 'status' => 'sakit', 'created_at' => MasterRekap::find(1)->tanggal_aktif_rekap])->count();
    }

    public function countAlfa()
    {
      return Absen::with('master_rekap')->where(['karyawan_id' => $this->karyawan->id, 'status' => 'alfa', 'created_at' => MasterRekap::find(1)->tanggal_aktif_rekap])->count();
    }


}
