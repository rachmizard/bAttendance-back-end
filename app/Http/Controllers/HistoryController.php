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
use App\Http\Resources\HistoryDashboardResource;

class HistoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('admin');
    }

    public function index()
    {
        return AbsenHistoryResource::collection(Karyawan::orderBy('nama', 'ASC')->paginate(20));
    }

    public function history()
    {
        return HistoryDashboardResource::collection(Absen::orderBy('created_at', 'DESC')->where('status', 'masuk')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get());
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


    public function destroyChecked(Request $request)
    {
        if ($request->checkedId) {
            foreach ($request->checkedId as $value) {
                Absen::destroy($value);
            }
        }
    }
}
