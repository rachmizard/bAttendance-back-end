<?php
use App\Events\ExpiredSession as Expired;
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

Route::get('/panel', function(){
	return view('home');
})->name('home')->middleware('admin');

Route::resource('laporan', 'LaporanController');

// Karyawan Routes
Route::get('karyawan', 'KaryawanController@index'); // VIEW
Route::get('karyawan/paginate', 'KaryawanController@paginate'); //FETCHING BY PAGINATE
Route::post('karyawan/post', 'KaryawanController@store'); // POST
Route::get('karyawan/{id}/edit', 'KaryawanController@edit'); // PATCH (UPDATE)
Route::put('karyawan/{id}/update', 'KaryawanController@update'); // PATCH (UPDATE)
Route::delete('karyawan/{id}/delete', 'KaryawanController@destroy'); // PATCH (UPDATE)

// History Routes
Route::get('history', 'HistoryController@index');
Route::delete('history/{id}/delete', 'HistoryController@destroy');
