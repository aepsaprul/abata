<?php

use App\Events\CustomerCs;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KaryawanController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('customer', CustomerController::class);
    Route::get('customer/{id}/delete', [CustomerController::class, 'delete'])->name('customer.delete');

    Route::resource('cabang', CabangController::class);
    Route::get('cabang/{id}/delete', [CabangController::class, 'delete'])->name('cabang.delete');

    Route::resource('jabatan', JabatanController::class);
    Route::get('jabatan/{id}/delete', [JabatanController::class, 'delete'])->name('jabatan.delete');

    Route::resource('karyawan', KaryawanController::class);
    Route::get('karyawan/{id}/delete', [KaryawanController::class, 'delete'])->name('karyawan.delete');

    Route::resource('menu', MenuController::class);
    Route::get('menu/{id}/delete', [MenuController::class, 'delete'])->name('menu.delete');

    Route::resource('user', UserController::class);
    Route::get('user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');

    // cabang
    Route::get('antrian/cs', [AntrianController::class, 'cs'])->name('antrian.cs');
    Route::get('antrian/cs/nomor', [AntrianController::class, 'csNomor'])->name('antrian.cs.nomor');

    Route::get('antrian/desainer', [AntrianController::class, 'desainer'])->name('antrian.desainer');
});

Route::get('antrian/customer', [AntrianController::class, 'customer'])->name('antrian.customer');
Route::post('antrian/customer/store', [AntrianController::class, 'customerStore'])->name('antrian.customer.store');
Route::get('antrian/customer/nomor', [AntrianController::class, 'customerNomor'])->name('antrian.customer.nomor');
Route::post('antrian/customer/sender', [AntrianController::class, 'customerSender'])->name('antrian.customer.sender');
Route::get('antrian/customer/{id}/form', [AntrianController::class, 'customerForm'])->name('antrian.customer.form');

Route::get('antrian/display', [AntrianController::class, 'display'])->name('antrian.display');
