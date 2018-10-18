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
        $countHadirJanuary = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '1')->count();
        $countHadirFebruari = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '2')->count();
        $countHadirMaret = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '3')->count();
        $countHadirApril = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '4')->count();
        $countHadirMei = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '5')->count();
        $countHadirJuni = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '6')->count();
        $countHadirJuly = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '7')->count();
        $countHadirAgustus = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '8')->count();
        $countHadirSeptember = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '9')->count();
        $countHadirOktober = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '10')->count();
        $countHadirNovember = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '11')->count();
        $countHadirDesember = Absen::where('karyawan_id', $request->filter)->where('status', 'masuk')->whereMonth('created_at', '12')->count();
        
        $countIzinJanuary = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '1')->count();
        $countIzinFebruari = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '2')->count();
        $countIzinMaret = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '3')->count();
        $countIzinApril = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '4')->count();
        $countIzinMei = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '5')->count();
        $countIzinJuni = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '6')->count();
        $countIzinJuly = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '7')->count();
        $countIzinAgustus = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '8')->count();
        $countIzinSeptember = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '9')->count();
        $countIzinOktober = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '10')->count();
        $countIzinNovember = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '11')->count();
        $countIzinDesember = Absen::where('karyawan_id', $request->filter)->where('status', 'izin')->whereMonth('created_at', '12')->count();
        $countSakitJanuary = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '1')->count();
        $countSakitFebruari = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '2')->count();
        $countSakitMaret = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '3')->count();
        $countSakitApril = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '4')->count();
        $countSakitMei = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '5')->count();
        $countSakitJuni = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '6')->count();
        $countSakitJuly = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '7')->count();
        $countSakitAgustus = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '8')->count();
        $countSakitSeptember = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '9')->count();
        $countSakitOktober = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '10')->count();
        $countSakitNovember = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '11')->count();
        $countSakitDesember = Absen::where('karyawan_id', $request->filter)->where('status', 'sakit')->whereMonth('created_at', '12')->count();
        $countAlfaJanuary = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '1')->count();
        $countAlfaFebruari = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '2')->count();
        $countAlfaMaret = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '3')->count();
        $countAlfaApril = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '4')->count();
        $countAlfaMei = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '5')->count();
        $countAlfaJuni = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '6')->count();
        $countAlfaJuly = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '7')->count();
        $countAlfaAgustus = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '8')->count();
        $countAlfaSeptember = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '9')->count();
        $countAlfaOktober = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '10')->count();
        $countAlfaNovember = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '11')->count();
        $countAlfaDesember = Absen::where('karyawan_id', $request->filter)->where('status', 'alfa')->whereMonth('created_at', '12')->count();
        $karyawan['karyawan'] = $data;
        $response['total_hadir_januari'] = $countHadirJanuary;
        $response['total_hadir_februari'] = $countHadirFebruari;
        $response['total_hadir_maret'] = $countHadirMaret;
        $response['total_hadir_april'] = $countHadirApril;
        $response['total_hadir_mei'] = $countHadirMei;
        $response['total_hadir_juni'] = $countHadirJuni;
        $response['total_hadir_juli'] = $countHadirJuly;
        $response['total_hadir_agustus'] = $countHadirAgustus;
        $response['total_hadir_september'] = $countHadirSeptember;
        $response['total_hadir_oktober'] = $countHadirOktober;
        $response['total_hadir_november'] = $countHadirNovember;
        $response['total_hadir_desember'] = $countHadirDesember;
        $response['total_izin_januari'] = $countIzinJanuary;
        $response['total_izin_februari'] = $countIzinFebruari;
        $response['total_izin_maret'] = $countIzinMaret;
        $response['total_izin_april'] = $countIzinApril;
        $response['total_izin_mei'] = $countIzinMei;
        $response['total_izin_juni'] = $countIzinJuni;
        $response['total_izin_juli'] = $countIzinJuly;
        $response['total_izin_agustus'] = $countIzinAgustus;
        $response['total_izin_september'] = $countIzinSeptember;
        $response['total_izin_oktober'] = $countIzinOktober;
        $response['total_izin_november'] = $countIzinNovember;
        $response['total_izin_desember'] = $countIzinDesember;
        $response['total_sakit_januari'] = $countSakitJanuary;
        $response['total_sakit_februari'] = $countSakitFebruari;
        $response['total_sakit_maret'] = $countSakitMaret;
        $response['total_sakit_april'] = $countSakitApril;
        $response['total_sakit_mei'] = $countSakitMei;
        $response['total_sakit_juni'] = $countSakitJuni;
        $response['total_sakit_juli'] = $countSakitJuly;
        $response['total_sakit_agustus'] = $countSakitAgustus;
        $response['total_sakit_september'] = $countSakitSeptember;
        $response['total_sakit_oktober'] = $countSakitOktober;
        $response['total_sakit_november'] = $countSakitNovember;
        $response['total_sakit_desember'] = $countSakitDesember;
        $response['total_alfa_januari'] = $countAlfaJanuary;
        $response['total_alfa_februari'] = $countAlfaFebruari;
        $response['total_alfa_maret'] = $countAlfaMaret;
        $response['total_alfa_april'] = $countAlfaApril;
        $response['total_alfa_mei'] = $countAlfaMei;
        $response['total_alfa_juni'] = $countAlfaJuni;
        $response['total_alfa_juli'] = $countAlfaJuly;
        $response['total_alfa_agustus'] = $countAlfaAgustus;
        $response['total_alfa_september'] = $countAlfaSeptember;
        $response['total_alfa_oktober'] = $countAlfaOktober;
        $response['total_alfa_november'] = $countAlfaNovember;
        $response['total_alfa_desember'] = $countAlfaDesember;
        return response()->json(['karyawan' => $data, 'total' => $response]);
    }
}
