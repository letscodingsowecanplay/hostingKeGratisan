<?php

use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

// Menampilkan form login siswa
Route::get('/login/siswa', [App\Http\Controllers\Auth\LoginController::class, 'showSiswaLoginForm'])->name('login.siswa');

// Menampilkan form login guru
Route::get('/login/guru', [App\Http\Controllers\Auth\LoginController::class, 'showGuruLoginForm'])->name('login.guru');


Route::post('/login/siswa', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.siswa');
Route::post('/login/guru', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.guru');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/health', function () {
    return response()->json(['status' => 'healthy', 'timestamp' => now()]);
});

Route::get('/db-test', function () {
    return [
        'DB_HOST' => env('DB_HOST'),
        'DB_PORT' => env('DB_PORT'),
        'MYSQLHOST' => env('MYSQLHOST'),
        'MYSQLPORT' => env('MYSQLPORT'),
    ];
});
