<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Verifikasi;
use Carbon\Carbon;
use App\Http\Resources\VerifikasiResource;
use App\Events\qrTrigger;
use Storage;

class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verifikasis = Verifikasi::all();
        return VerifikasiResource::collection($verifikasis);
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
        $getDate = Carbon::now();
        $parse = Carbon::parse($getDate);
        // $arr = explode(' ',trim($getDate));
        $verifikasi = new Verifikasi;
        $id = $verifikasi->id;
        // Generate Pin
        $pin = 0;
        $i = '';
        while ($i < 3) {
            $pin .= mt_rand(0, 9);
            $i++;
        }
        if ($verifikasi) {
            $verifikasi->pin = substr($pin, -2).substr($parse->second, -1).substr($parse->minute, -1);
            $verifikasi->qrcode = \QrCode::size(200)->generate(substr($pin, -2).substr($parse->second, -1).substr($parse->minute, -1), '../public/storage/qrcode_'. $pin .'.png');
            $verifikasi->save();
        }
        event(new qrTrigger('Hello'));
        return response()->json(['data' => $verifikasi]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $verifikasi = Verifikasi::find($id);
        $verifikasi->delete();

        return response()->json($verifikasi);
    }
}
