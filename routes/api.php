<?php

use Illuminate\Http\Request;
use App\Events\qrTrigger;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/////////////////////////////////// START EXAMPLE /////////////////////////////////////////////

// Route::post('/generate', function(Request $request){
// 	$requestPin = $request->get('pin');
// 	$date = Carbon::now();
// 	$qrcode = ['pin' => $requestPin, 'date' => $date];
// 	event(new qrTrigger($qrcode));

// 	return response()->json(['status' => 'successfully generated QRCODE', 'data' => $qrcode]);
// });

Route::get('/fetch', 'QRCodeController@index');
Route::post('/fetch/post', 'QRCodeController@store');
Route::delete('/fetch/delete/{id}', 'QRCodeController@destroy');

Route::post('/add/verifikasi', 'QRCodeController@store');

/////////////////////////////////// END EXAMPLE /////////////////////////////////////////////


/////////////////////////////////// START REAL LIFE /////////////////////////////////////////////

// Login Apps Begin
Route::post('login', 'API\APIController@loginApps');

// Login Apps Begin
Route::post('validasi', 'API\APIController@show');

// Register Apps to be changed status karyawan
Route::post('register', 'API\APIController@registerApps');

// Register Apps new Pin Karyawan
Route::post('register/pin', 'API\APIController@registerAppsPin');

// We'll started to create presence action
Route::post('masuk', 'API\APIController@masuk');

// We'll started to create presence action
Route::post('keluar', 'API\APIController@keluar');

// We'll started to create presence action
Route::post('mabal', 'API\APIController@mabal');

// We'll started to create presence action
Route::post('lembur', 'API\APIController@lembur');

// We'll started to create random key action
Route::post('generate', 'API\APIController@generate');

// We'll started to create history for fetching data in android
Route::get('history', 'API\APIController@history');


// We'll started to create user's history for fetching data in android
Route::get('myhistory/{id}/show', 'API\APIController@myHistory');

// We'll started edit's action from presence
/*
	In this part we're using put method for edit the data.
*/
Route::put('absen/{id}/edit', 'API\APIController@editAbsen');


// We'll started change status' action from presence
/*
	In this part we're using put method for edit the data.
*/
Route::put('verifikasi/{id}/edit', 'API\APIController@changeStatus');


// We'll started change status' action from presence
/*
	In this part we're using get method for edit the data.
*/
Route::get('verifikasi/{id}/show', 'API\APIController@showVerifikasi');

// We'll started delete's action from presence
/*
	In this part we're using delete method for destroy the data.
*/
Route::delete('absen/{id}/delete', 'API\APIController@deleteAbsen');


/*
	Create New Karyawan Resource
*/
Route::post('karyawan/post', 'API\APIController@postKaryawan'); // POST

// We'll started validation's action for pulang
/*
	Create New Pulang Resource
*/
Route::get('pulang', 'API\APIController@pulang'); // POST

// We'll started overtime's code after pulang
/*
	Create Overtime Resource
*/
Route::get('over', 'API\APIController@over');

// We'll started validation's action for pulang

/*
	In this part we're using put method for update & input an alasan
*/

Route::put('telat/{id}/alasan', 'API\APIController@telat');

/*
	In this part we're using put method for edit the new pin.
*/
// Route::put('karyawan/pin', 'API\APIController@forgotPin');

/////////////////////////////////// END REAL LIFE /////////////////////////////////////////////
