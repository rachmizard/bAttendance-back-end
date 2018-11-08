<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lembur;
use App\Karyawan;
use App\Absen;
use App\MasterFilter;
use Carbon\Carbon;
use App\Http\Resources\LemburResource;

class LemburController extends Controller
{
   // 	public function __construct()
  	// {
  	// 	$this->middleware('auth');
  	// }

  	public function lembur()
  	{
  		return LemburResource::collection(Lembur::whereIn('status', ['true', 'false'])->whereDate('created_at', Carbon::parse(MasterFilter::find(1)->value('tgl_history')))->paginate(25));
  	}

  	public function approveLembur(Request $request, $id)
  	{
  		$lembur = Lembur::find($id);
  		$lembur->status = 'true';
  		$lembur->update();
  		return response()->json(['message' => 'success']);
  	}

  	public function batalLembur(Request $request, $id)
  	{
  		$lembur = Lembur::find($id);
  		$lembur->status = 'false';
  		$lembur->update();
  		return response()->json(['message' => 'success']);

  	}

  	public function hapusLembur($id)
  	{
  		return Lembur::find($id)->delete();
  	}
}
