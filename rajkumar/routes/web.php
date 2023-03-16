<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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

// Route::get('/', function () {
//     return view('index');
// }); 

Route::get('/', [IndexController::class, 'index']);

Route::get('/execution-time', function () { 
   return view('execution_time');
}); 

Route::post('/form-execution-time', [IndexController::class, 'insert']);

Route::get('/ip-address', [IndexController::class, 'ip_address']);

Route::get('/ip-address-coockie-based', [IndexController::class, 'ip_address_cookies_based']);

Route::get('/open-text-map', [IndexController::class, 'open_text_map']);

Route::get('/exporting-id', [IndexController::class, 'exporting_id']);

Route::get('/email-sent', [IndexController::class, 'to_send_email']);

Route::post('/email-sent', [IndexController::class, 'email_sent']);





