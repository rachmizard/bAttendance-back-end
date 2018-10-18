<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Karyawan;
use App\Lembur;
use App\User;
use App\Verifikasi;
use Carbon\Carbon;
use App\Http\Resources\AbsenHistoryResource;

class HistoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        return AbsenHistoryResource::collection(Absen::where('status', 'masuk')->orderBy('created_at', 'DESC')->paginate(20));
    }

    public function history()
    {
        return AbsenHistoryResource::collection(Absen::orderBy('created_at', 'DESC')->where('status', 'masuk')->where('created_at', Carbon::now()->format('Y-m-d'))->get());
    }

    public function indexview()
    {
        return view('history.index');
    }

    public function destroy($id)
    {
    	$absen = Absen::find($id);
    	return $absen->delete();
    }
}
