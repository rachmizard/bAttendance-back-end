<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Absen;
use App\Rekap;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\RekapResource;
use App\Karyawan;
use App\MasterRekap;
use DB;

class RekapController extends Controller
{
    public function index()
    {
      return view('rekap.index');
    }

    public function jsonRekap()
    {
      return Datatables::of(RekapResource::collection(Absen::all()))->make(true);
    }

    public function store(Request $request)
    {
      // code...
    }

    public function show($id)
    {
      // code...
    }

    public function edit($id)
    {
      // code...
    }

    public function selectMasterRekap()
    {
      return MasterRekap::find(1);
    }

    public function updateMasterRekap(Request $request)
    {
      $get = MasterRekap::find(1);
      $get->tanggal_aktif_rekap = $request->tanggal_aktif_rekap;
      $get->update();

      $response['status'] = 'kosong';
      $response['title'] = 'Sukses!';
      $response['message'] = 'Berhasil di setting master tanggal rekap!';
      $response['type'] = 'success';
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
