<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', 'admin\HomeController@index')->name('admin.dashboard');
});

Route::group(['prefix' => 'keuangan'], function () {
    Route::get('dashboard', 'keuangan\HomeController@index')->name('keuangan.dashboard');
    Route::get('kwitansi', 'keuangan\KwitansiController@index')->name('keuangan.kwitansi');
    Route::get('profile', 'keuangan\ProfileController@index')->name('keuangan.profile');
});

Route::group(['prefix' => 'panitia'], function () {
    Route::get('dashboard', 'panitia\HomeController@index')->name('panitia.dashboard');
});

