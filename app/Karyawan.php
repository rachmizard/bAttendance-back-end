<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'nama', 'jenis_kelamin', 'divisi', 'nik', 'pin', 'status'
    ];

    public function absen()
    {
    	return $this->hasMany(Absen::class, 'id');
    }

    public function lembur()
    {
    	return $this->hasMany(Lembur::class, 'id');
    }

}
