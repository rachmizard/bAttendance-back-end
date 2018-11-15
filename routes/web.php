<?php
use App\Events\ExpiredSession as Expired;
use App\Events\Absen as AbsenEvent;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('estimation', function(){
	$start = Carbon::parse('2018-09-10 07:00:00');
	$pause = Carbon::parse('2018-09-10 17:00:00');

	return $diffInSeconds = $pause->diffInHours($start).' jam/'.$pause->diffInSeconds($start).' menit/';
});

Route::get('/randomabsen', function(){

    // Get date now
    $validator = Carbon::today()->format('Y-m-d');
    // Check if data is already exist for presence today
    $check = \App\Absen::where('karyawan_id', request(rand(82, 110)))->where('status', 'masuk')->whereDate('created_at', $validator)->get();
    if (!count($check) > 0) {
		$data['karyawan_id'] = rand(1, 10);
		$data['verifikasi_id'] = rand(1, 4);
		$data['status'] = 'masuk';
		$data['alasan'] = null;
	    $title = 'Absen Notifikasi';
	    $message =  \App\Karyawan::find($data['karyawan_id'])->nama .' melakukan absen masuk hari ini '. Carbon::now()->format('d-m-Y H:i:s');
	    $type = 'success';
	    $image = 'foto.jpg';
	    event(new AbsenEvent($title, $message, $type, $image));
		return \App\Absen::create($data);
    }else{

		$data['karyawan_id'] = rand(82, 110);
		$data['verifikasi_id'] = rand(1, 14);
		$data['status'] = 'masuk';
		$data['alasan'] = null;
	    $title = 'Absen Notifikasi';
	    $message =  \App\Karyawan::find($data['karyawan_id'])->nama .' sudah melakukan absen masuk hari ini '. Carbon::now()->format('d-m-Y H:i:s');
	    $type = 'success';
	    $image = 'foto.jpg';
	    event(new AbsenEvent($title, $message, $type, $image));
		return 'sudah absen';
    }
});

Route::get('/expired', function(){
	if (!auth()->user()) {
		$title = "Session error";
		$message = "You're not authorized or your session was expired!";
		$type = "danger";
		event(new Expired($title, $message, $type));
		return response()->json([
			'users' => Auth::user()
		]);
	}else{
		$title = "Session active";
		$message = "You're now authorized!";
		$type = "success";
		event(new Expired($title, $message, $type));
		return response()->json([
			'users' => Auth::user()
		]);
	}
});

Route::get('/absentest', function(){
        $title = 'Absen Notifikasi';
        $message =  'Seseorang melakukan absen masuk hari ini '. Carbon\Carbon::now()->format('d-m-Y H:i:s');
        $type = 'success';
        $image = 'foto.jpg';
        event(new AbsenEvent($title, $message, $type, $image));
});


	Route::get('/panel', 'HomeController@index')->name('home');
	Route::get('resetpassword', 'LupaPasswordController@index')->name('resetpassword.index');
	Route::post('resetpassword', 'LupaPasswordController@resetpassword')->name('resetpassword.resetpassword');
	Route::get('profile', 'ProfileController@index')->name('profile.index');
	Route::post('profile', 'ProfileController@profile')->name('profile.profile');
	Route::get('dashboard', 'HomeController@dashboard')->name('home.dashboard'); // DASHBOARD COUNT

	Route::resource('laporan', 'LaporanController');

	// Karyawan Routes
	// Json Return
	Route::get('karyawan/json', 'KaryawanController@jsonKaryawan')->name('jsonKaryawan');
	// End Json Return

	Route::get('karyawan', 'KaryawanController@index')->name('karyawan'); // VIEW
	Route::get('karyawan/paginate', 'KaryawanController@paginate'); //FETCHING BY PAGINATE
	Route::post('karyawan/post', 'KaryawanController@store'); // POST
	Route::get('karyawan/{id}/edit', 'KaryawanController@edit'); // PATCH (UPDATE)
	// Route::put('karyawan/{id}/update', 'KaryawanController@update'); // PATCH (UPDATE) for VUE JS
	Route::put('karyawan/{id}/update', 'KaryawanController@updateRequest'); // PATCH (UPDATE)
	Route::post('karyawan/{id}/delete', 'KaryawanController@destroy'); // PATCH (UPDATE)

	Route::post('karyawan/import', 'KaryawanImportController@import'); // PATCH (UPDATE)
	Route::post('karyawan/exportKaryawan', 'KaryawanImportController@exportKaryawan')->name('karyawan.exportKaryawan'); // PATCH (UPDATE)
	Route::post('karyawan/{id}/uploadFp', 'KaryawanImportController@storeFp')->name('karyawan.store.fp');
	// Route::delete('karyawan/json/{id}/delete', 'KaryawanController@destroyJson'); // PATCH (UPDATE)

	Route::get('jam', 'JamController@index')->name('jam.index');
	Route::post('jam/post', 'JamController@store')->name('jam.post');
	Route::delete('jam/{id}/delete', 'JamController@destroy')->name('jam.destroy');
	Route::put('jam/{id}/aktifkan', 'JamController@aktifkan')->name('jam.aktifkan');
	Route::put('jam/{id}/matikan', 'JamController@matikan')->name('jam.matikan');

	Route::get('lembur', function(){
		return view('lembur.approval-lembur');
	})->name('approval-lembur.index');
	Route::get('lembur/karyawan', 'LemburController@lembur')->name('approval-lembur.lembur');
	Route::put('lembur/{id}/approveLembur', 'LemburController@approveLembur')->name('approval-lembur.approveLembur');
	Route::put('lembur/{id}/batalLembur', 'LemburController@batalLembur')->name('approval-lembur.batalLembur');
	Route::delete('lembur/{id}/hapusLembur', 'LemburController@hapusLembur')->name('approval-lembur.hapusLembur');

	// History Routes
	Route::get('history', 'HistoryController@index')->name('history.index');
	Route::get('history/today', 'HistoryController@history')->name('history.history');
	Route::get('historyabsensi', 'HistoryController@indexview')->name('history.indexview');
	Route::delete('history/{id}/delete', 'HistoryController@destroy')->name('history.destroy');
	Route::post('history/deleteChecked', 'HistoryController@destroyChecked'); // PATCH (UPDATE)

	// Absen admin
	Route::get('absen-admin', 'AbsenAdminController@view')->name('absen-admin.view');
	Route::get('absen-admin/retrieve', 'AbsenAdminController@retrieve')->name('absen-admin.retrieve');
	Route::post('absen-admin/store', 'AbsenAdminController@store')->name('absen-admin.store');
	Route::get('absen-admin/{id}/edit', 'AbsenAdminController@edit')->name('absen-admin.edit');
	Route::post('absen-admin/{id}/update', 'AbsenAdminController@update')->name('absen-admin.update');
	Route::post('absen-admin/{id}/destroy', 'AbsenAdminController@destroy')->name('absen-admin.destroy');
	Route::post('absen-admin/destroyChecked', 'AbsenAdminController@destroyChecked')->name('absen-admin.destroyChecked');

	// Rekap Admin Routes
	Route::get('rekap-admin', 'RekapController@index')->name('rekap-admin.index');
	Route::get('rekap-admin/json', 'RekapController@jsonRekap');
	Route::get('rekap-admin/{id}/detail', 'RekapController@detail')->name('rekap-admin.detail');
	Route::get('rekap-admin/{id}/rekapDetailKaryawan', 'RekapController@rekapDetailKaryawan')->name('rekap-admin.rekapDetailKaryawan');
	Route::get('rekap-admin/selectMasterRekap', 'RekapController@selectMasterRekap');
	Route::put('rekap-admin/{id}/updateMasterRekap', 'RekapController@updateMasterRekap');
	Route::get('rekap-admin/export', 'RekapController@export')->name('rekap-admin.export');

	// Master Filter Routes
	Route::post('master-filter/getFilterHistory', 'MasterFilterController@update')->name('master-filter.update');
	Route::get('master-filter/getFilterHistory', 'MasterFilterController@show')->name('master-filter.get');

	// CRON JOB

	Route::get('autocheckout', function(){
		$data = App\Absen::where('status', 'keluar')->whereDate('created_at', Carbon::now()->format('Y-m-d'));
		$checkIn = App\Absen::where('status', 'masuk')->whereDate('created_at', Carbon::now()->format('Y-m-d'));
		if ($checkIn->count() > 0) {
			$check = App\Absen::where('status', 'masuk')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->get();
			foreach ($check as $value) {
				$check_lagi = App\Absen::where('karyawan_id', $value->karyawan_id)->where('status', 'keluar')->whereDate('created_at', Carbon::now()->format('Y-m-d'))->count();
				if ($check_lagi == 0) {		
	                $date = Carbon::now();
	                $parse = Carbon::parse($date);
	                $get_master_jam = App\Jam::where('status', 1)->first();
	                $verifikasi = new App\Verifikasi;
	                $verifikasi->pin = 'LUPA CHECKOUT';
	                $verifikasi->status = '2';
	                $verifikasi->created_at =  Carbon::create($date->year, $date->month, $date->day, Carbon::parse($get_master_jam['end'])->format('H'), Carbon::parse($get_master_jam['end'])->format('i'), Carbon::parse($get_master_jam['end'])->format('s'))->toDateTimeString();
	                $verifikasi->updated_at =  Carbon::create($date->year, $date->month, $date->day, Carbon::parse($get_master_jam['end'])->format('H'), Carbon::parse($get_master_jam['end'])->format('i'), Carbon::parse($get_master_jam['end'])->format('s'))->toDateTimeString();
	                $verifikasi->save();
	                // INSERT TO DATABASE!
	                $newAbsen = new App\Absen;
	                $newAbsen->verifikasi_id = $verifikasi->id;
	                $newAbsen->karyawan_id = $value->karyawan_id;
	                $newAbsen->status = 'keluar';
	                $newAbsen->alasan = null;
	                $newAbsen->save();

                	$parse_checkin = $value->verifikasi->updated_at;
                	$parse_checkout = $newAbsen->verifikasi->created_at;
                	$parse_jam_tolerance = Carbon::parse($get_master_jam['tolerance']);
                	$newRekap = new App\RekapDurasi;
                	$newRekap->durasi_kerja = 32400;
                	if ($parse_checkin->format('H:i:s') > Carbon::parse($get_master_jam['tolerance'])->format('H:i:s')) {
                		$newRekap->durasi_telat = $parse_jam_tolerance->diffInSeconds($parse_checkin);
                	}else{
                		$newRekap->durasi_telat = 0;
                	}
                	$newRekap->karyawan_id = $value->karyawan_id; 
                	$newRekap->save();
				}
			}
		}else{
           if (!$checkIn->count() > 0) {
           	foreach ($checkIn->get() as $alfa) {
               	$date = Carbon::now();
                $parse = Carbon::parse($date);
                $get_master_jam = App\Jam::where('status', 1)->first();
                $verifikasi = new App\Verifikasi;
                $verifikasi->pin = 'ALFA';
                $verifikasi->status = '2';
                $verifikasi->created_at =  Carbon::create($date->year, $date->month, $date->day, Carbon::parse($get_master_jam['end'])->format('H'), Carbon::parse($get_master_jam['end'])->format('i'), Carbon::parse($get_master_jam['end'])->format('s'))->toDateTimeString();
                $verifikasi->updated_at =  Carbon::create($date->year, $date->month, $date->day, Carbon::parse($get_master_jam['end'])->format('H'), Carbon::parse($get_master_jam['end'])->format('i'), Carbon::parse($get_master_jam['end'])->format('s'))->toDateTimeString();
                $verifikasi->save();
                // INSERT TO DATABASE!
                $newAbsen = new App\Absen;
                $newAbsen->verifikasi_id = $verifikasi->id;
                $newAbsen->karyawan_id = $alfa->karyawan_id;
                $newAbsen->status = 'alfa';
                $newAbsen->alasan = null;
                $newAbsen->save();
           	}
           }
		}
		return response()->json(['message' => 'success']);
	});

	Route::get('autofilter', function(){
		$master_filter = App\MasterFilter::find(1);
		$master_filter->tgl_history = Carbon::today()->format('Y-m-d');
		$master_filter->update();
		return response()->json(['message' => 'Auto filter has been resetted!']);
	});