<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



// Route::get('home', function () {
//     return view('welcome');
// });
// Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index');


    Route::get('/index_out_going', 'ScanOutgoingController@index_out_going')->name('index_out_going');
    Route::get('/get_datatables_outtrans', 'ScanOutgoingController@get_datatables_outtrans')->name('get_datatables_outtrans');
    Route::get('/validasi_po', 'ScanOutgoingController@validasi_po')->name('validasi_po');
    Route::post('/store_data_trans', 'ScanOutgoingController@store_data_trans')->name('store_data_trans');
    Route::post('/delete_outgoing_datatables', 'ScanOutgoingController@delete_outgoing_datatables')->name('delete_outgoing_datatables');
    Route::post('/post_bpb', 'ScanOutgoingController@post_bpb')->name('post_bpb');
    // bpb generate
    Route::get('/index_bpb', 'BpbGenerateController@index_bpb')->name('index_bpb');
    Route::get('/get_datatables_bpb', 'BpbGenerateController@get_datatables_bpb')->name('get_datatables_bpb');
    Route::get('/generate_bpb_pdf/{id}/{bpb}', 'BpbGenerateController@generate_bpb_pdf')->name('generate_bpb_pdf');
});
// Tampilkan form login kustom
Route::get('/login', 'CustomLoginController@showLoginForm');

// Proses login kustom
Route::post('/login', 'CustomLoginController@login')->name('login');

// Logout kustom
Route::post('/logout', 'CustomLoginController@logout')->name('logout');
