<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Absen;
use App\Rekap;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapExport;
use App\Exports\RekapDetailKaryawanExport;
use App\Http\Resources\RekapResource;
use App\Http\Resources\RekapDetailResource;
use App\Karyawan;
use App\MasterRekap;
use App\MasterFilter;
use App\Events\DrawTableEvent;
use DB;

class RekapController extends Controller
{

    public function __construct()
    {
      $this->middleware('admin');
    }

    public function index()
    {
      return view('rekap.index');
    }

    public function jsonRekap()
    {
      $getMasterRekap = MasterRekap::find(1);
      $now = Carbon::now();
      $data = Karyawan::where('status', 'authorized')->get();
      return Datatables::of(RekapResource::collection(Karyawan::where('status', 'authorized')->get()))
      ->rawColumns(['total_lembur', 'total_telat'])
      ->make(true);
    }

    public function export()
    {
      return Excel::download(new RekapExport ,'hasil_rekapan_'. MasterRekap::find(1)->tanggal_aktif_rekap .'_'. Carbon::now()->format('Y') .'.xlsx');
    }

    public function exportDetail(Request $request)
    {
      $requestAll = $request->all();

      $karyawanIdentity = Karyawan::find($requestAll['karyawan_id']);

      // parsing date
      $start_date = Carbon::parse($requestAll['start_date'])->format('Y-m-d');

      $end_date = Carbon::parse($requestAll['end_date'])->format('Y-m-d');

      $karyawanId = $karyawanIdentity->id;

      $file_name = $karyawanIdentity->nama . '_laporan_absen_' . $start_date . '_' . $end_date . '.xlsx';

      return Excel::download(new RekapDetailKaryawanExport($start_date, $end_date, $karyawanId), $file_name);
    }

    public function detail($id)
    {
      return new RekapResource(Karyawan::find($id));
    }

    public function rekapDetailKaryawan(Request $request, $id)
    {
      return RekapDetailResource::collection(Absen::orderBy('created_at', 'ASC')->where(['karyawan_id' => $id])
            ->whereIn('status', ['masuk', 'izin', 'sakit', 'alfa', 'dinas'])
            ->whereBetween('created_at', [new Carbon(MasterRekap::find(1)->start), new Carbon(MasterRekap::find(1)->end)])->get());
    }

    public function selectMasterRekap()
    {
      return MasterRekap::find(1);
    }

    public function updateMasterRekap(Request $request)
    {
      $this->validate($request, [
            'tahun' => 'required',
            'bulan_awal' => 'required'
      ]);

      $get = MasterRekap::find(1);
      $get->tanggal_aktif_rekap = $request->bulan_awal;
      $get->start = 'first day of '. $request->bulan_awal .' '.$request->tahun;
      $get->end = 'last day of '. $request->bulan_awal .' '.$request->tahun;
      $get->update();

      $response['status'] = 'kosong';
      $response['title'] = 'Sukses!';
      $response['message'] = 'Berhasil di setting master tanggal rekap!';
      $response['type'] = 'success';
      event(new DrawTableEvent());
      return response()->json(['response' => $response]);
    }

    public function update(Request $request, $id)
    {
      // code...
    }

    public function destroy($id)
    {
      // code...
    }

    public function destroyChecked(Request $request)
    {
      // code...
    }
}
