<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jam;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jams = Jam::all();
        // return response()->json($jam);
        return view('jam.index', compact('jams'));
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
        $this->validate($request, [
            'start'  => 'required|string|max:50',
            'end'  => 'required|string|max:50',
            'tolerance' => 'required|string|max:50'
        ]);
        
        $jam = new Jam();
        $jam->start = $request->start;
        $jam->tolerance = $request->tolerance;
        $jam->end = $request->end;
        if ($jam->save()) {
            $response['status'] = 'success';
            $response['title'] = 'Sukses!';
            $response['message'] = 'Berhasil menambahkan master jam!';
            $response['type'] = 'success';
            return response()->json(['response' => $response]);
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
        $jam = Jam::whereId('id', $id)->first();
         if (empty($jam)) {
            return response()->json([
                'message' => 'Master Jam not found.',
            ], 404);
        }
        return response()->json($jam);
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
        $this->validate($request, [
            'start'  => 'required|string|max:50',
            'end'  => 'required|string|max:50'
        ]);

        if (!$request->status) {
            $jam = Jam::find($id);
            $jam->start = $request->start;
            $jam->end = $request->end;
            if (empty($jam)) {
                $response['status'] = 'failed';
                $response['title'] = 'Gagal!';
                $response['message'] = 'Gagal mengedit data, terjadi error!';
                $response['type'] = 'danger';
                return response()->json(['response' => $response]);
            }else{
                $jam->update();
                $response['status'] = 'success';
                $response['title'] = 'Sukses!';
                $response['message'] = 'Berhasil mengedit master jam!';
                $response['type'] = 'success';
                return response()->json(['response' => $response]);
            }
        }else{
            $jam = Jam::find($id);
            $jam->start = $request->status;
            return response()->json(['status' => 'success']);
        }
    }

    public function aktifkan($id)
    {
        // Set all to default 
        $get = Jam::pluck('id')->toArray();
        $set = Jam::whereIn('id', $get)->update(['status' => null]);
        if ($set) {
            $jam = Jam::find($id);
            $jam->status = 1;
            $jam->update();
        }
        return redirect()->back();
    }


    public function matikan($id)
    {
        // Set all to default 
        $jam = Jam::find($id);
        $jam->status = null;
        $jam->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jam = Jam::findOrFail($id);
        $jam->delete();
        return redirect()->back()->with('message', 'Berhasil di hapus!');
    }


    public function destroySS($id)
    {
        $jam = Jam::findOrFail($id);
        $jam->delete();
        $response['status'] = 'success';
        $response['title'] = 'Sukses!';
        $response['message'] = 'Berhasil menambahkan master jam!';
        $response['type'] = 'success';
        return response()->json(['response' => $response]);
    }
}
