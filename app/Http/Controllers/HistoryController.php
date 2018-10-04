<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Karyawan;
use App\Lembur;
use App\User;
use App\Verifikasi;
use App\Http\Resources\AbsenHistoryResource;

class HistoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        return AbsenHistoryResource::collection(Absen::orderBy('created_at', 'DESC')->get());
    }
}
