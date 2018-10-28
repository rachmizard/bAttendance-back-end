<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class HistoryDashboardResource extends Resource
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
            'fp' => $this->karyawan->fp == null ? $this->karyawan->jenis_kelamin == 'L' ? 'http://localhost:8000/storage/images/default.jpg' : 'http://localhost:8000/storage/images/default_female.jpg' : 'http://localhost:8000/storage/images/'. $this->karyawan->fp .'',
            'checkin' => $this->created_at->format('Y-m-d H:i:s'),
            'text_message' => 'Hai saya '. $this->karyawan->nama .' telah checkin '. $this->created_at->diffForHumans()
        ];
    }
}
