<?php

namespace App\Http\Controllers;

use App\Imports\KaryawanImport;
use App\Exports\KaryawanExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class KaryawanImportController extends Controller
{
  
  	public function __construct()
  	{
  		$this->middleware('auth');
  	}

    public function import(Request $request)
    {
      $this->validate($request, [
          'file_name' => 'required|file'
      ]);

      Excel::import(new KaryawanImport, request('file_name'));

      return redirect()->back();

    }

    
    public function exportKaryawan() 
    {
        return Excel::download(new KaryawanExport, 'karyawan_biru_tekno_'. Carbon::now()->format('Y') .'.xlsx');
    }
}
