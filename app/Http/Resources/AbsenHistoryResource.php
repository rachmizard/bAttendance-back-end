<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

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
            'karyawan_id' => $this->karyawan_id,
            'nama' => $this->karyawan->nama,
            'divisi' => $this->karyawan->divisi,
            'action' => $this->status,
            'jam' => $this->verifikasi->created_at->format('H:i:s A'),
            'tanggal' => $this->verifikasi->created_at->diffForHumans(),
            'created_at' => $this->verifikasi->created_at->format('d-m-Y'),
            'telah_masuk' => $this->verifikasi->created_at->diffForHumans()
        ];
    }
}
