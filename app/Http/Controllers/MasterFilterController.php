<?php

namespace App\Http\Controllers;

use App\MasterFilter;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Events\DrawTableEvent;

class MasterFilterController extends Controller
{
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
     * @param  \App\MasterFilter  $masterFilter
     * @return \Illuminate\Http\Response
     */
    public function show(MasterFilter $masterFilter)
    {
        $filter = MasterFilter::findOrFail(1);
        setlocale(LC_TIME, 'ID');
        return response()->json(['tgl_history' => $filter->tgl_history->format('Y-m-d'), 'previewFilter' => Carbon::parse($filter->tgl_history)->formatLocalized('%d %B %Y')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterFilter  $masterFilter
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterFilter $masterFilter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterFilter  $masterFilter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'tgl_history' => 'required|date'
        ]);

        $getFilter = MasterFilter::findOrFail(1);
        $getFilter->tgl_history = Carbon::parse($request->tgl_history)->format('Y-m-d');
        $getFilter->update();
        $response['status'] = 'kosong';
        $response['title'] = 'Sukses!';
        $response['message'] = 'Berhasil di setting master tanggal rekap!';
        $response['type'] = 'success';
        // event(new DrawTableEvent());
        return response()->json(['response' => $response]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterFilter  $masterFilter
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterFilter $masterFilter)
    {
        //
    }
}
