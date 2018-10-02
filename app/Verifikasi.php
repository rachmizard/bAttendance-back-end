<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verifikasi extends Model
{
    protected $table = 'verifikasis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status', 'pin'
    ];

    public function absen()
    {
    	return $this->hasMany(Absen::class, 'id');
    }
}
