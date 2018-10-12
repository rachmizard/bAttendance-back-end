<?php
use App\Events\ExpiredSession as Expired;
use App\Events\Absen as AbsenEvent;
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


Route::get('/qrcode', function(){
	return view('qrpage');
});

Auth::routes();

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

Route::resource('laporan', 'LaporanController');

// Karyawan Routes
Route::get('karyawan', 'KaryawanController@index')->name('karyawan'); // VIEW
Route::get('karyawan/paginate', 'KaryawanController@paginate'); //FETCHING BY PAGINATE
Route::post('karyawan/post', 'KaryawanController@store'); // POST
Route::get('karyawan/{id}/edit', 'KaryawanController@edit'); // PATCH (UPDATE)
// Route::put('karyawan/{id}/update', 'KaryawanController@update'); // PATCH (UPDATE) for VUE JS
Route::put('karyawan/{id}/update', 'KaryawanController@updateRequest'); // PATCH (UPDATE) 
Route::delete('karyawan/{id}/delete', 'KaryawanController@destroy'); // PATCH (UPDATE)

Route::get('jam', 'JamController@index')->name('jam.index');
Route::post('jam/post', 'JamController@store')->name('jam.post');
Route::delete('jam/{id}/delete', 'JamController@destroy')->name('jam.destroy');
Route::put('jam/{id}/aktifkan', 'JamController@aktifkan')->name('jam.aktifkan');
Route::put('jam/{id}/matikan', 'JamController@matikan')->name('jam.matikan');


// History Routes
Route::get('history', 'HistoryController@index');
Route::delete('history/{id}/delete', 'HistoryController@destroy');
