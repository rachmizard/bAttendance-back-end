<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Absen;
use App\Verifikasi;
use Carbon\Carbon;

class AbsenHistoryResource extends Resource
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
        $jam = Absen::where(['karyawan_id' => $this->id, 'status' => 'masuk'])->whereDate('created_at', Carbon::now()->format('Y-m-d'))->value('created_at');
        return [
            'id' => $this->id,
            'karyawan_id' => $this->id,
            'nama' => $this->nama,
            'divisi' => $this->divisi,
            'action' => $this->status,
            // 'jam' => $this->verifikasi->created_at->format('h:i:s A'),
            'jam' => $jam == null ? '-' : Carbon::parse($jam)->diffForHumans(),
            'checkin' => $this->checkInKaryawan() == null ? '-' : Carbon::parse($this->checkInKaryawan())->format('H:i:s'),
            'checkout' => $this->checkOutKaryawan() == null ? 'Belum pulang' : Carbon::parse($this->checkOutKaryawan())->format('H:i:s'),
            // 'tanggal' => $this->verifikasi->created_at->diffForHumans(),
            'tanggal' => $this->absenId() == null ? '-' : Carbon::parse($this->absenId())->diffForHumans(),
            // 'created_at' => $this->verifikasi->created_at->format('d-m-Y'),
            'created_at' => $this->absenId() == null ? '-' : Carbon::parse($this->absenId())->format('d-m-Y'),
            // 'telah_masuk' => $this->verifikasi->created_at->diffForHumans(),
            'telah_masuk' => $this->absenId() == null ? '-' : Carbon::parse($this->absenId())->diffForHumans(),
            'text_message' => $this->absenId() == null ? '-' : 'Hai, saya telah masuk '. Carbon::parse($this->absenId())->diffForHumans()
        ];
    }

    public function absenId()
    {
        $getAbsenId = Absen::where(['karyawan_id' => $this->id])->whereDate('created_at', Carbon::now()->format('Y-m-d'))->value('verifikasi_id');
        return Verifikasi::where(['id' => $getAbsenId])->value('created_at');
    }

    public function checkInKaryawan()
    {
        return Absen::where(['karyawan_id' => $this->id, 'status' => 'masuk'])->whereDate('created_at', Carbon::now()->format('Y-m-d'))->value('created_at');
        // return response()->json(['status' => 'masuk']);
    }

    public function checkOutKaryawan()
    {
        $checkOut = Absen::where(['karyawan_id' => $this->karyawan_id, 'status' => 'keluar', 'created_at' => Carbon::now()->format('Y-m-d')])->value('created_at');
        return $checkOut;
        // return response()->json(['status' => 'keluar']);
    }
}
