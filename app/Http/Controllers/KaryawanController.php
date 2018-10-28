<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawan;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Events\DrawTableEvent;
use App\Http\Resources\DashboardResource;
use Illuminate\Support\Facades\Input;
use Storage;

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

    public function jsonKaryawan()
    {
        $karyawans = Karyawan::all();
        return Datatables::of(Karyawan::all())
                ->addColumn('action', function($karyawans){
                    return '
                            <button type="button" class="btn btn-sm btn-info" data-target="#editKaryawanModal" data-toggle="modal" data-id="'. $karyawans->id .'" data-nik="'. $karyawans->nik .'" data-nama="'. $karyawans->nama .'" data-divisi="'. $karyawans->divisi .'" data-jenis_kelamin="'. $karyawans->jenis_kelamin .'" data-status="'. $karyawans->status .' data-fp='. $karyawans->fp .'"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-sm btn-danger" data-target="#deleteModal" data-toggle="modal" data-id="'. $karyawans->id .'"><i class="fa fa-trash-o"></i></button>
                            ';
                })
                ->addColumn('fp', function($karyawans){
                    return $karyawans->fp == null ? '<img src="/storage/images/default.png" width="40" height="40" alt="">' : '<img width="40" height="40" src="/storage/images/'. $karyawans->fp .'" alt="">';
                })
                ->editColumn('status', function($karyawans){
                    if ($karyawans->status == 'unauthorized') {
                        return '<span class="label label-danger">'. $karyawans->status .'</span>';
                    }else{
                        return '<span class="label label-success">'. $karyawans->status .'</span>';
                    }
                })
                ->rawColumns(['action', 'fp', 'status'])
                ->make(true);
    }

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
            'jabatan' => 'required|string|max:50',
            'divisi' => 'required|string|max:50'
        ]);

        $validator = Karyawan::where('nik', $request->nik)->get();
        if (count($validator) > 0) {
            $response['status'] = 'exist';
            $response['title'] = 'Gagal!';
            $response['message'] = 'NIK sudah terdaftar atau sudah ada!';
            $response['type'] = 'danger';
            return response()->json(['response' => $response]);
            // return redirect()->back()->with('message', $response['message']);
        }else{
               if ($request->hasFile('image')) {
                   $name = str_random(15). '.' .$request->image->getClientOriginalExtension();
                   if (file_exists(public_path('storage/images/'. $name))) {
                        Storage::delete(public_path('storage/images/'. $name));
                           $path = public_path('storage/images/');
                           $request->image->move($path, $name);
                   }else{
                       $path = public_path('storage/images/');
                       $request->image->move($path, $name);
                   }
               }
            $karyawan = new Karyawan;
            $karyawan->nama = $request->nama;
            $karyawan->jabatan = $request->jabatan;
            $karyawan->divisi = $request->divisi;
            $karyawan->jenis_kelamin = $request->jenis_kelamin;
            $karyawan->nik = Carbon::now()->format('y') . Carbon::now()->format('m') . Carbon::now()->format('i') . Carbon::now()->format('s');
            $karyawan->status = $request->status;
            $karyawan->fp = $karyawan->fp == null ? '' : $name;
            $karyawan->save();

            $response['status'] = 'kosong';
            $response['title'] = 'Sukses!';
            $response['message'] = 'Berhasil di tambahkan '. $karyawan->nama;
            $response['type'] = 'success';
            event(new DrawTableEvent());
            // return response()->json(['response' => $response]);
            return redirect()->back();
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
            'jabatan' => 'required|string|max:50',
            'divisi' => 'required|string|max:50',
        ]);
        // $validator = Karyawan::where('nik', $request->nik)->get();
        // if (count($validator) > 1) {
        //     return redirect()->back()->with('message', 'NIK Sudah terdaftar!');
        // }else{
            $karyawan = Karyawan::find($id);
            if ($karyawan->nik) {
                $karyawan->nama = $request->get('nama');
                $karyawan->nik = $request->get('nik');
                $karyawan->jabatan = $request->get('jabatan');
                $karyawan->divisi = $request->get('divisi');
                $karyawan->jenis_kelamin = $request->get('jenis_kelamin');
                $karyawan->status = $request->get('status');
                $karyawan->update();
                event(new DrawTableEvent());
                return redirect()->back()->with('message', 'Berhasil di update!');
            // }
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
        return response()->json($karyawan);
        // return redirect()->back()->with('message', 'Berhasil di hapus!');
    }
}
