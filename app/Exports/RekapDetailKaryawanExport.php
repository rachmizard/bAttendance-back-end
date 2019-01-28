<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Absen;
use DB;

class RekapDetailKaryawanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    private $start_date;
    private $end_date;
    private $karyawan;

    public function __construct($start_date, $end_date, $karyawan)
    {
    	$this->start_date = $start_date;
    	$this->end_date = $end_date;
    	$this->karyawan = $karyawan;
    }

    public function view(): View
    {

    	$karyawan = DB::table('karyawans')->find($this->karyawan)->nama;

    	$parseStartDate = Carbon::parse($this->start_date)->format('Y-m-d');

    	$parseEndDate = Carbon::parse($this->end_date)->format('Y-m-d');

    	$months = CarbonPeriod::create($this->start_date, $this->end_date);

    	$rekapans = [];

    	$items = array();

    	foreach ($months as $key => $value) {

    		$validator = '23:59:00';

    		$yang_masuk = Absen::with('verifikasi')->whereKaryawanId($this->karyawan)
    							->whereStatus('masuk')->whereDate('created_at', $value->format('Y-m-d'))->first();

			$yang_keluar = Absen::with('verifikasi')->whereKaryawanId($this->karyawan)
			->whereStatus('keluar')->whereDate('created_at', $value->format('Y-m-d'))->first();

    		$yang_izin = Absen::with('verifikasi')->whereKaryawanId($this->karyawan)
    							->whereStatus('izin')->whereDate('created_at', $value->format('Y-m-d'))->first();

			$yang_sakit = Absen::with('verifikasi')->whereKaryawanId($this->karyawan)
			->whereStatus('sakit')->whereDate('created_at', $value->format('Y-m-d'))->first();

			$yang_alfa = Absen::with('verifikasi')->whereKaryawanId($this->karyawan)
			->whereStatus('alfa')->whereDate('created_at', $value->format('Y-m-d'))->first();

			$yang_dinas = Absen::with('verifikasi')->whereKaryawanId($this->karyawan)
			->whereStatus('dinas')->whereDate('created_at', $value->format('Y-m-d'))->first();

    		$rekapans['tgl'] = $value->format('d');

    		$rekapans['hari'] = $value->format('l');

    		$rekapans['jam_masuk'] = $yang_masuk ? $yang_masuk['verifikasi']['updated_at']->format('H:i:s') : '' ;

    		$rekapans['jam_keluar'] = $yang_keluar ? $yang_keluar['verifikasi']['updated_at']->format('H:i:s') : '' ;

	    	$rekapans['hadir'] = $yang_masuk ? 'true' : '';

			$rekapans['izin'] = $yang_izin ? 'true' : false;

			$rekapans['sakit'] = $yang_sakit ? 'true' : false;

			$rekapans['alfa'] = $yang_alfa ? 'true' : false;

			$rekapans['dinas'] = $yang_dinas ? 'true' : false;

			$rekapans['keterangan'] = $yang_masuk ? $yang_masuk['alasan'] : 'Lupa Absen';

    		array_push($items, $rekapans);

    		// var_dump($yang_sakit);
    	}

    	// return response()->json($items);

    	// dd($items);

        return view('rekap.rekap-detail', compact('karyawan', 'items'));
    }
}
