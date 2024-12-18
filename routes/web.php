<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

    // Rute untuk pengguna dengan role: 1 (Admin)
    Route::group(['middleware' => ['role:1']], function () {
        Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
        Route::resource('role', 'App\Http\Controllers\RoleController', ['except' => ['show']]);
        Route::resource('kondisi', 'App\Http\Controllers\KondisiController', ['except' => ['show']]);
        Route::resource('barang', 'App\Http\Controllers\BarangController', ['except' => ['show']]);
        Route::resource('kotak', 'App\Http\Controllers\KotakController', ['except' => ['show']]);
    });

    // Rute untuk pengguna dengan role: 1 atau 2
    Route::group(['middleware' => ['role:1,2']], function () {
        Route::put('inspeksi/approve/{id}', ['as' => 'inspeksi.approve', 'uses' => 'App\Http\Controllers\InspeksiController@approve']);
        Route::put('inspeksi/tolak/{id}', ['as' => 'inspeksi.tolak', 'uses' => 'App\Http\Controllers\InspeksiController@tolak']);
        
        // Laporan Pemakaian
        Route::get('laporan-pemakaian-print', ['as' => 'laporan.pemakaian.print', 'uses' => 'App\Http\Controllers\PelaporanController@print']);
        Route::get('laporan-pemakaian-pdf', ['as' => 'laporan.pemakaian.pdf', 'uses' => 'App\Http\Controllers\PelaporanController@downloadPDF']);
        Route::get('laporan-pemakaian-excel', ['as' => 'laporan.pemakaian.excel', 'uses' => 'App\Http\Controllers\PelaporanController@downloadExcel']);
        
        // Laporan Checklist
        Route::get('laporan-checklist-print/{id}', ['as' => 'laporan.checklist.print', 'uses' => 'App\Http\Controllers\LaporChecklistController@print']);
        Route::get('laporan-checklist-pdf/{id}', ['as' => 'laporan.checklist.pdf', 'uses' => 'App\Http\Controllers\LaporChecklistController@downloadPDF']);
        Route::get('laporan-checklist-excel/{id}', ['as' => 'laporan.checklist.excel', 'uses' => 'App\Http\Controllers\LaporChecklistController@downloadExcel']);
    });

    // Rute untuk pengguna dengan role: 1, 2, 3, atau 4
    Route::group(['middleware' => ['role:1,2,3,4']], function () {
        Route::resource('pemakaian', 'App\Http\Controllers\PemakaianController');
    });

    // Rute untuk pengguna dengan role: 1, 2, atau 3
    Route::group(['middleware' => ['role:1,2,3']], function () {
        Route::resource('inspeksi', 'App\Http\Controllers\InspeksiController');
        
        // Profil Pengguna
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    });
});

Route::get('/test-email', function () {
    Mail::raw('Test!', function ($message) {
        $message->to('burlleyjaya@gmail.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
})->name("send-email");


