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
    return view('welcome');
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
		$data['karyawan_id'] = rand(82, 110);
		$data['verifikasi_id'] = rand(1, 14);
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

Route::get('/panel', 'HomeController@index')->name('home')->middleware('admin');
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

// Route::delete('karyawan/json/{id}/delete', 'KaryawanController@destroyJson'); // PATCH (UPDATE)

Route::get('jam', 'JamController@index')->name('jam.index');
Route::post('jam/post', 'JamController@store')->name('jam.post');
Route::delete('jam/{id}/delete', 'JamController@destroy')->name('jam.destroy');
Route::put('jam/{id}/aktifkan', 'JamController@aktifkan')->name('jam.aktifkan');
Route::put('jam/{id}/matikan', 'JamController@matikan')->name('jam.matikan');


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
Route::get('rekap-admin/selectMasterRekap', 'RekapController@selectMasterRekap');
Route::put('rekap-admin/{id}/updateMasterRekap', 'RekapController@updateMasterRekap');
Route::get('rekap-admin/export', 'RekapController@export')->name('rekap-admin.export');
