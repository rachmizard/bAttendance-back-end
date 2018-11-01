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
            'divisi' => $this->karyawan->divisi . ' / ' . $this->karyawan->jabatan,
            'jam' => $this->verifikasi->created_at->format('h:i:s A'),
            'foto' => $this->karyawan->fp != null ? 'http://192.168.1.12:8000/storage/images/'. $this->karyawan->fp : 'http://192.168.1.12:8000/images/avatar_default.jpg',
            'action' => $this->status
        ];
    }
}
