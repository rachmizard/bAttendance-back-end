<?php

namespace App\Http\Controllers;

use App\Imports\KaryawanImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanImportController extends Controller
{
    public function import(Request $request)
    {
      $this->validate($request, [
          'file_name' => 'required|file'
      ]);

      Excel::import(new KaryawanImport, request('file_name'));

      return redirect()->back();

    }
}
