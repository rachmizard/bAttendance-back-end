<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Verifikasi;
use App\Karyawan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countKaryawan = Karyawan::where('status', ['authorized', 'unauthorized'])->count();
        $countKehadiran = Absen::where('status', 'masuk')->count();
        return view('home', compact('countKaryawan', 'countKehadiran'));
    }
}
