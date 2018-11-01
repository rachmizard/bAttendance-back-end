<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ResepsionisHistoryResource extends Resource
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
            'nama' => $this->karyawan->nama,
            'divisi' => $this->karyawan->divisi,
            'jam' => $this->verifikasi->created_at->format('h:i:s A'),
            'foto' => 'http://192.168.1.9:8000/storage/images/'. $this->karyawan->fp,
            'action' => $this->status
        ];
    }
}
