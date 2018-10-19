<?php

namespace App\Http\Controllers;

use App\User;
use App\Karyawan;
use App\Absen;
use App\Verifikasi;
use Carbon\Carbon;
use App\Events\DrawTableEvent;
use Illuminate\Http\Request;

class AbsenAdminController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function view()
    {
      return view('absen.index');
    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'karyawan_id' => 'required',
        'status' => 'required'
      ]);

      $date = Carbon::now();
      $parse = Carbon::parse($date);
      $verifikasi = new Verifikasi;
      // Generate Pin
      $pin = 0;
      $i = '';
      while ($i < 3) {
          $pin .= mt_rand(0, 9);
          $i++;
      }
      if ($verifikasi) {
          $verifikasi->status = '2';
          $verifikasi->pin = substr($pin, -2).substr($parse->second, -1).substr($parse->minute, -1);
          $verifikasi->save();
      }

      $absenAdmin = new Absen;
      $absenAdmin->karyawan_id = $request->karyawan_id;
      $absenAdmin->verifikasi_id = $verifikasi->id;
      $absenAdmin->status = $request->status;
      $absenAdmin->alasan = $request->alasan;
      $absenAdmin->save();

      $response['status'] = 'kosong';
      $response['title'] = 'Sukses!';
      $response['message'] = 'Berhasil di tambahkan absensi!';
      $response['type'] = 'success';
      event(new DrawTableEvent());

      return response()->json(['response' => $response]);

    }

    public function edit($id)
    {
      return Absen::find($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
          'karyawan_id' => 'required',
          'status' => 'required'
        ]);

        $absenAdmin = Absen::findOrFail($id);
        $absenAdmin->karyawan_id = $request->karyawan_id;
        $absenAdmin->status = $request->status;
        $absenAdmin->alasan = $request->alasan;
        $absenAdmin->update();

        return response()->json($absenAdmin);
    }

    public function destroy($id)
    {
      return Absen::destroy($id);
    }

    public function destroyChecked(Request $request)
    {
      if ($request->id_absen) {
        foreach ($request->id_absen as $value) {
          Absen::destroy($value);
        }
      }
    }


}
