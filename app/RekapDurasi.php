<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapDurasi extends Model
{
    protected $table = 'rekap_durasi';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'durasi_kerja', 'durasi_telat', 'karyawan_id'
    ];

    public function karyawan()
    {
      $this->belongsTo(Karyawan::class, 'karyawan_id', 'id');
    }
}
