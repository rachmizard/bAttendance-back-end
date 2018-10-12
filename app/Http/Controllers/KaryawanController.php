<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use Carbon\Carbon;

class KaryawanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = Karyawan::orderBy('nama', 'ASC')->get();
        return view('karyawan.index', compact('karyawans'));
    }

    public function paginate()
    {
        $karyawans = Karyawan::orderBy('nama', 'ASC')
            ->paginate(request('limit', 20));
        if (request()->all()) {
            $karyawans->appends(request()->all());
        }
        return response()->json($karyawans);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'nama'  => 'required|string|max:50',
            'jenis_kelamin'  => 'required|string|max:50',
            'nik' => 'required|numeric', 
            'divisi' => 'required|string|max:50', 
        ]);

        $validator = Karyawan::where('nik', $request->nik)->get();
        if (count($validator) > 0) {
            $response['status'] = 'exist';
            $response['message'] = 'NIK sudah terdaftar atau sudah ada!';
            return response()->json(['response' => $response]);
            // return redirect()->back()->with('message', $response['message']);
        }else{
            $karyawan = new Karyawan;
            $karyawan->nama = $request->nama;
            $karyawan->divisi = $request->divisi;
            $karyawan->jenis_kelamin = $request->jenis_kelamin;
            $karyawan->nik = $request->nik;
            $karyawan->save();

            $response['status'] = 'kosong';
            $response['message'] = 'Berhasil di tambahkan '. $karyawan->nama;
            return response()->json(['response' => $response]);
            // return redirect()->back()->with('message', 'Berhasil di tambahkan!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = Karyawan::whereId($id)->first();
        if (empty($karyawan)) {
            return response()->json([
                'message' => 'Karyawan not found.',
            ], 404);
        }
        return response()->json($karyawan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Karyawan::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //      $this->validate($request, [
    //         'nama'  => 'required|string|max:50',
    //         'jenis_kelamin'  => 'required|string|max:50',
    //         'nik' => 'required', 
    //         'divisi' => 'required|string|max:50', 
    //     ]);

    //     $validator = Karyawan::where('nik', $request->nik)->get();
    //     if (count($validator) > 1) {
    //         $response['status'] = 'exist';
    //         $response['message'] = 'NIK Sudah ada!';
    //         return response()->json(['response' => $response]);
    //     }else{
    //         $karyawan = Karyawan::find($id);
    //         if ($karyawan->nik) {
    //             $karyawan->nama = $request->get('nama');
    //             $karyawan->divisi = $request->get('divisi');
    //             $karyawan->jenis_kelamin = $request->get('jenis_kelamin');
    //             $karyawan->nik = $request->get('nik');
    //             $karyawan->update();
    //             $response['status'] = 'kosong';
    //             $response['message'] = 'Berhasil di edit!';
    //             return response()->json(['response' => $response, 'karyawan' => $karyawan]);
    //         }
    //     }
    // }

    public function updateRequest(Request $request, $id)
    {
         $this->validate($request, [
            'nama'  => 'required|string|max:50',
            'jenis_kelamin'  => 'required|string|max:50',
            'nik' => 'required', 
            'divisi' => 'required|string|max:50', 
        ]);
        $validator = Karyawan::where('nik', $request->nik)->get();
        if (count($validator) > 1) {
            return redirect()->back()->with('message', 'NIK Sudah terdaftar!');
        }else{
            $karyawan = Karyawan::find($id);
            if ($karyawan->nik) {
                $karyawan->nama = $request->get('nama');
                $karyawan->divisi = $request->get('divisi');
                $karyawan->jenis_kelamin = $request->get('jenis_kelamin');
                $karyawan->nik = $request->get('nik');
                $karyawan->update();
                return redirect()->back()->with('message', 'Berhasil di update!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        // return response()->json($karyawan);
        return redirect()->back()->with('message', 'Berhasil di hapus!');
    }
}
