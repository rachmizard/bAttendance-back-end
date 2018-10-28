<?php

namespace App\Http\Controllers;

use App\User;
use App\Karyawan;
use App\Absen;
use App\Verifikasi;
use Carbon\Carbon;
use App\Events\DrawTableEvent;
use App\Events\Absen as AbsenEvent;
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

      $check = Absen::where('karyawan_id', $request->karyawan_id)->whereDate('created_at', Carbon::now()->format('Y-m-d'))->count();
      if (!$check > 0) {
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
          $image = 'foto.jpg';
          $title = 'Berhasil!';
          $message = 'Berhasil menambahkan '. Karyawan::find($absenAdmin->karyawan_id)->nama .' ke absensi dengan status '. $absenAdmin->status .'!';
          $type = 'success';
          event(new AbsenEvent($title, $message, $type, $image));
      }else{
          $image = 'foto.jpg';
          $title = 'Gagal!';
          $message = 'Karyawan tersebut sudah melakukan absen!';
          $type = 'warning';
          $response['status'] = 'ada';
          $response['title'] = 'Gagal!';
          $response['message'] = 'Gagal menambahkan absensi!';
          $response['type'] = 'danger';
          event(new AbsenEvent($title, $message, $type, $image));
      }

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
      if ($request->checkedId) {
        foreach ($request->checkedId as $value) {
          Absen::destroy($value);
        }
      }
    }


}
