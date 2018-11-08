<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Karyawan;
use App\Jam;
use App\Lembur;
use App\Verifikasi;
use App\MasterFilter;
use Carbon\Carbon;

class LemburResource extends Resource
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
            'karyawan' => $this->karyawan,
            'durasi' => $this->durasi." jam",
            'status' => $this->status,
            'alasan' => $this->alasan
        ];
    }

    public function filterHistory()
    {
        return MasterFilter::findOrFail(1)->value('tgl_history');
    }

    // public function durasi()
    // {
    //     return Lembur::where('karyawan_id', $this->karyawan->id)->value('durasi');
    // }

    // public function status()
    // {
    //     return Lembur::where('karyawan_id', $this->id)->value('status');
    // }
}
