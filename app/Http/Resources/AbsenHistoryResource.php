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
        return [
            'id' => $this->id,
            'karyawan_id' => $this->id,
            'nama' => $this->nama,
            'divisi' => $this->divisi,
            'action' => $this->status,
            // 'jam' => $this->verifikasi->created_at->format('h:i:s A'),
            'jam' => $this->absenId(),
            'checkin' => $this->checkInKaryawan(),
            'checkout' => $this->checkOutKaryawan(),
            // 'tanggal' => $this->verifikasi->created_at->diffForHumans(),
            'tanggal' => $this->absenId(),
            // 'created_at' => $this->verifikasi->created_at->format('d-m-Y'),
            'created_at' => $this->absenId(),
            // 'telah_masuk' => $this->verifikasi->created_at->diffForHumans(),
            'telah_masuk' => $this->absenId(),
            'text_message' => 'Hi, saya telah masuk '
        ];
    }

    public function absenId()
    {
        $getAbsenId = Absen::where(['karyawan_id' => $this->id, 'created_at' => Carbon::now()->format('Y-m-d')])->pluck('verifikasi_id');
        $this->verifikasiIn($getAbsenId);
        return Absen::where(['karyawan_id' => $this->id, 'status' => 'masuk', 'created_at' => Carbon::now()->format('Y-m-d')])->first();
    }

    public function verifikasiIn($id)
    {
        return Verifikasi::findOrFail($id);
    }

    public function checkInKaryawan()
    {
        $checkIn = Absen::where(['karyawan_id' => $this->id, 'status' => 'masuk', 'created_at' => Carbon::now()->format('Y-m-d')])->value('created_at');
        return $checkIn;
        // return response()->json(['status' => 'masuk']);
    }

    public function checkOutKaryawan()
    {
        $checkOut = Absen::where(['karyawan_id' => $this->karyawan_id, 'status' => 'keluar', 'created_at' => Carbon::now()->format('Y-m-d')])->value('created_at');
        return $checkOut;
        // return response()->json(['status' => 'keluar']);
    }
}
