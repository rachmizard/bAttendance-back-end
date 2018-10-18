<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Verifikasi;
use App\Karyawan;
use App\Http\Resources\DashboardResource;

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

    public function dashboard(Request $request)
    {
        $data = Karyawan::find($request->filter);
        $countHadir = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->count();
        $countIzin = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->count();
        $countSakit = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->count();
        $countAlfa = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->count();
        $karyawan['karyawan'] = $data;
        $response['total_hadir'] = $countHadir;
        $response['total_izin'] = $countIzin;
        $response['total_sakit'] = $countSakit;
        $response['total_alfa'] = $countAlfa;
        return response()->json(['karyawan' => $data, 'total' => $response]);
    }
}
