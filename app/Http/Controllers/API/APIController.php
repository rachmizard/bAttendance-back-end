<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Resources\AbsenHistoryResource;
use App\Http\Controllers\Controller;
use App\Karyawan;
use App\Absen;
use App\Lembur;
use App\Verifikasi;
use Auth;
use Carbon\Carbon;
use Validator;
use Input;

class APIController extends Controller
{


    /**
     * Login users apps listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginApps(Request $request)
    {
        $nik = Karyawan::where('nik', '=', request('nik'))->first();
        if(count($nik) > 0){
            if ($nik['status'] == 'unauthorized') {
                // Get this ID 
                $karyawanID = null;
                $response['message'] = 'unauthorized';
                return response()->json(['response' => $response, 'karyawan' => $karyawanID ]);
            }else if($nik['status'] == 'authorized') {
                // Get this ID 
                $karyawanID = Karyawan::where('nik', request('nik'))->first();
                $response['message'] = 'success';
                return response()->json(['response' => $response, 'karyawan' => $karyawanID ]);
            }else{
                // Get this ID 
                $karyawanID = null;
                $response['message'] = 'vacant';
                return response()->json(['response' => $response, 'karyawan' => $karyawanID ]);
            }
        }else{
            $response['message'] = 'failed';
            return response()->json(['response' => $response, 'karyawan' => null ]);
        }
    }

    /**
     * Register a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerApps(Request $request)
    {
         $getNik = Karyawan::where('nik', request('nik'))->first();
         if (count($getNik) > 0) {
             if ($getNik['status'] == 'unauthorized') {
                 $getID = Karyawan::find($getNik['id']);
                 $getID->status = 'authorized';
                 $getID->update();
                 $response['message'] = 'success';
                 return response()->json(['response' => $response, 'karyawan' => $getID]);
             }else{
                 $getID = Karyawan::find($getNik['id']);
                 $response['message'] = 'failed';
                 return response()->json(['response' => $response, 'karyawan' => $getID]);
             }
         }else{  
            $response['message'] = 'failed';
            return response()->json(['response' => $response, 'karyawan' => null]);
         }
    }

    /**
     * Register a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerAppsPin(Request $request)
    {
         $getNik = Karyawan::where('nik', request('nik'))->first();
         if (count($getNik) > 0) {
             $getID = Karyawan::find($getNik['id']);
             $getID->pin = request('pin');
             $getID->update();
             return response()->json(['karyawan' => $getID]);
         }else{  
             return response()->json(['karyawan' => null]);
         }
    }

    /**
     * Generate pin the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        // Generate random PIN
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
            $verifikasi->status = '0';
            $verifikasi->pin = substr($pin, -2).substr($parse->second, -1).substr($parse->minute, -1);
            $verifikasi->save();
        }

        return response()->json(['id' => (string)$verifikasi->id, 'pin' => $verifikasi->pin]);
    }

    /**
     * Started absen resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function masuk(Request $request)
    {
        $getDate = Carbon::now();
        // Get date now
        $validator = Carbon::today()->format('Y-m-d');
        // Check if data is already exist for presence today
        $check = Absen::where('karyawan_id', request('karyawan_id'))->where('status', 'masuk')->whereDate('created_at', $validator)->get();
        if (!count($check) > 0) {
            $masuk = new Absen();
            $masuk->karyawan_id = $request->input('karyawan_id');
            $masuk->verifikasi_id = $request->input('verifikasi_id');
            $masuk->status = 'masuk';
            $masuk->alasan = null;
            $masuk->save();
            return response()->json(['message' => 'success', 'id' => $masuk->id]);
        }else{
            return response()->json(['message' => 'failed']);
        }
    }

    /**
     * Started keluar presence resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function keluar(Request $request)
    {
        $getDate = Carbon::now();
        // Get date now
        $validator = Carbon::today()->format('Y-m-d');
        // Check if data is already exist for out today
        $check = Absen::where('karyawan_id', request('karyawan_id'))->where('status', 'keluar')->whereDate('created_at', $validator)->get();
        if (!count($check) > 0) {
            // Generate random PIN
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
            $keluar = new Absen();
            $keluar->karyawan_id = $request->input('karyawan_id');
            $keluar->verifikasi_id = $verifikasi->id;
            $keluar->status = 'keluar';
            $keluar->alasan = $request->input('alasan');
            $keluar->save();
            return response()->json(['message' => 'success', 'id' => $keluar->id]);
        }else{
            return response()->json(['message' => 'failed']);
        }
    }

     /**
     * Started mabal presence resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mabal(Request $request)
    {
        $getDate = Carbon::now();
        // Get date now
        $validator = Carbon::today()->format('Y-m-d');
        // Check if data is already exist for out today
        $check = Absen::where('karyawan_id', request('karyawan_id'))->where('status', 'keluar')->whereDate('created_at', $validator)->get();
        if (!count($check) > 0) {
            // Generate random PIN
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
            $keluar = new Absen();
            $keluar->karyawan_id = $request->input('karyawan_id');
            $keluar->verifikasi_id = $verifikasi->id;
            $keluar->status = 'keluar';
            $keluar->alasan = $request->input('alasan');
            $keluar->save();
            return response()->json(['message' => 'success', 'id' => $keluar->id]);
        }else{
            return response()->json(['message' => 'failed']);
        }
    }

    public function editAbsen($id)
    {
        $absen = Absen::find($id);
        $absen->verifikasi_id = request('verifikasi_id');
        $absen->update();
        return response()->json(['message' => 'success', 'id' => $absen->id]);
    }

    public function deleteAbsen($id)
    {
        $absen = Absen::find($id);
        $absen->delete();
        return response()->json(['message' => 'success', 'id' => $absen->id]);
    }

    /**
     * Started lembur presence resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lembur(Request $request)
    {
        $getDate = Carbon::now();
        // Get date now
        $validator = Carbon::today()->format('Y-m-d');
        // Check if data is already exist for overtime today
        $check = Lembur::where('karyawan_id', request('karyawan_id'))->whereDate('created_at', $validator)->get();
        if (!count($check) > 0) {
            $lembur = new Lembur();
            $lembur->karyawan_id = $request->input('karyawan_id');
            $lembur->durasi = $request->input('durasi');
            $lembur->alasan = $request->input('alasan');
            $lembur->save();
            return response()->json(['message' => 'success', 'id' => $lembur->id]);
        }else{
            return response()->json(['message' => 'failed']);
        }
    }

    /**
     * Change status verification presence resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, $id)
    {
        $verifikasi = Verifikasi::find($id);
        $verifikasi->status = request('status');
        $verifikasi->update();
        return response()->json(['message' => 'success', 'id' => $verifikasi->id]);
    }

    /**
     * Detail status verification presence resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showVerifikasi($id)
    {
        $verification = Verifikasi::findOrFail($id);
        return response()->json(['id' => (string)$verification->id, 'pin' => $verification->pin, 'status' => $verification->status]);
    }
    
    /**
     * Fetching data presence resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        return AbsenHistoryResource::collection(Absen::orderBy('created_at', 'DESC')->get());
    }
    
    /**
     * Fetching data by users id presence resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myHistory(Request $request, $id)
    {
        return AbsenHistoryResource::collection(Absen::where('karyawan_id', $id)->get());
    }

    /**
     * Forgot users's pin resource
     *
     * @return \Illuminate\Http\Response
     */
    public function forgotPin()
    {
        $getNik = Karyawan::where('nik', request('nik'))->first();
        $newpin = Karyawan::findOrFail($getNik['id']);
        $newpin->pin = request('pin');
        if ($newpin->update()) {
            $response['status'] = 'success';
            $response['pin'] = request('pin');
        }
        return response()->json(['response' => $response]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $getNik = Karyawan::where('nik', request('nik'))->first();
        if (count($getNik) > 0) {
            $response['message'] = 'exist';
            return response()->json(['response' => $response, 'karyawan' => $getNik]);
        }else{  
            $response['message'] = 'empty';
            return response()->json(['response' => $response, 'karyawan' => null]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
