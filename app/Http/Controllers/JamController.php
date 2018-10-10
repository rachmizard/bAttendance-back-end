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
        $jam = Jam::all();
        return response()->json($jam);
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
            'end'  => 'required|string|max:50'
        ]);
        
        $jam = new Jam();
        $jam->start = $request->start;
        $jam->end = $request->end;
        if ($jam->save()) {
            return response()->json($jam);
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

        $jam = Jam::find($$id);
        $jam->start = $request->start;
        $jam->end = $request->end;
        if (empty($jam)) {
            return response()->json($jam);
        }else{
            $jam->update();
            return resource()->json($jam);   
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
        $jam = Jam::findOrFail($id);
        $jam->delete();
        return response()->json($jam);
    }
}
