<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Absen;
use App\MasterRekap;
use App\RekapDurasi;
use App\Lembur;
use App\Jam;
use Carbon\Carbon;

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
          'nik' => $this->nik,
          'karyawan' => parent::toArray($request),
          'fp' => $this->fp == null ? $this->jenis_kelamin == 'L' ? 'http://attendance.birutekno.com/storage/images/default.jpg' : 'http://attendance.birutekno.com/storage/images/default_female.jpg' : 'http://attendance.birutekno.com/public/storage/images/'. $this->fp .'',
          'jml_hadir' => $this->countHadir() == 0 ? '0' : $this->countHadir(),
          'jml_izin' => $this->countIzin() == 0 ? '0' : $this->countIzin(),
          'jml_sakit' => $this->countSakit() == 0 ? '0' : $this->countSakit(),
          'jml_alfa' => $this->countAlfa() == 0 ? '0' : $this->countAlfa(),
          'jml_dinas' => $this->countDinas() == 0 ? '0' : $this->countDinas(),
          'total_lembur' => $this->countLemburDuration() == 0 ? 'Belum Lembur' : $this->countLemburDuration(). ' Jam',
          'lembur_total' => $this->berapaKaliDiaLembur() == 0 ? 'Belum Lembur' : $this->berapaKaliDiaLembur(). ' kali',
          'total_telat' => $this->countTelat() . ' kali',
          'total_jam_kerja_sebulan' => $this->countWorkDurationSelamaSebulan(),
          'total_jam_telat_sebulan' => $this->countTelatDurationSelamaSebulan()
        ];
    }

    public function countHadir()
    {
      return Absen::where(['karyawan_id' => $this->id, 'status' => 'keluar'])
            ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])
            ->count();
    }

    public function countIzin()
    {
      return Absen::where(['karyawan_id' => $this->id, 'status' => 'izin'])
            ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])
            ->count();
    }

    public function countSakit()
    {
      return Absen::where(['karyawan_id' => $this->id, 'status' => 'sakit'])
            ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])
            ->count();
    }

    public function countAlfa()
    {
      return Absen::where(['karyawan_id' => $this->id, 'status' => 'alfa'])
            ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])
            ->count();
    }

    public function countDinas()
    {
      return Absen::where(['karyawan_id' => $this->id, 'status' => 'dinas'])
            ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])
            ->count();
    }

    public function countLemburDuration()
    {
      return Lembur::where(['karyawan_id' => $this->id])->where('status', 'true')
            ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])
            ->sum('durasi');
    }

    public function berapaKaliDiaLembur()
    {
      return Lembur::where(['karyawan_id' => $this->id])->where('status', 'true')
            ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])
            ->count();
    }

    public function countTelat()
    {
      $find_jam = Jam::where('status', 1)->first();
      $total_jam_telat = Absen::where(['karyawan_id' => $this->id, 'status' => 'masuk'])
      ->whereTime('created_at', '>=', Carbon::parse($find_jam['tolerance'])->format('H:i:s'))
      ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])->count('created_at');
      return $total_jam_telat;
    }

    public function countWorkDurationSelamaSebulan()
    {
      $ambil_data = RekapDurasi::where('karyawan_id', $this->id)->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])->sum('durasi_kerja');
      $init = $ambil_data;
      $hours = floor($init / 3600);
      $minutes = floor(($init / 60) % 60);
      $seconds = $init % 60;
      // return gmdate('H:i:s', $ambil_data);
      return "$hours jam $minutes menit $seconds detik";
    }

    public function countTelatDurationSelamaSebulan()
    {
      $ambil_data = RekapDurasi::where('karyawan_id', $this->id)->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])->sum('durasi_telat');
      $init = $ambil_data;
      $hours = floor($init / 3600);
      $minutes = floor(($init / 60) % 60);
      $seconds = $init % 60;
      // return gmdate('H:i:s', $ambil_data);
      return "$hours jam $minutes menit $seconds detik";
    }

}
