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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', 'admin\HomeController@index')->name('admin.dashboard');
    Route::post('invoice/approv', 'admin\InvoiceController@approv')->name('admin.invoice.approv');
    Route::post('invoice/decline', 'admin\InvoiceController@decline')->name('admin.invoice.decline');
    Route::resource('user', 'admin\UsersController');
    Route::resource('barang', 'admin\BarangController');
    Route::resource('invoices', 'admin\InvoiceController');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('dashboard', 'user\HomeController@index')->name('user.dashboard');
    Route::get('invoice', 'user\InvoiceController@index')->name('user.invoice');
    Route::get('invoice/detail/{id}', 'user\InvoiceController@detail')->name('user.invoice.detail');
    Route::resource('invoice', 'user\InvoiceController');
});

