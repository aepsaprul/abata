<?php

use App\Events\CustomerCs;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\SitumpurController;
use App\Http\Controllers\MasterMenuController;
use App\Http\Controllers\MasterCabangController;
use App\Http\Controllers\MasterJabatanController;
use App\Http\Controllers\MasterCustomerController;
use App\Http\Controllers\MasterKaryawanController;

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
    Route::resource('customer', MasterCustomerController::class);
    Route::get('customer/{id}/delete', [MasterCustomerController::class, 'delete'])->name('customer.delete');

    Route::resource('cabang', MasterCabangController::class);
    Route::get('cabang/{id}/delete', [MasterCabangController::class, 'delete'])->name('cabang.delete');

    // Route::resource('desainer', MasterDesainerController::class);
    // Route::get('desainer/{id}/delete', [MasterDesainerController::class, 'delete'])->name('desainer.delete');

    Route::resource('jabatan', MasterJabatanController::class);
    Route::get('jabatan/{id}/delete', [MasterJabatanController::class, 'delete'])->name('jabatan.delete');
    Route::get('jabatan/{id}/akses', [MasterJabatanController::class, 'akses'])->name('jabatan.akses');
    Route::put('jabatan/{id}/akses/simpan', [MasterJabatanController::class, 'aksesSimpan'])->name('jabatan.akses.simpan');

    Route::resource('karyawan', MasterKaryawanController::class);
    Route::get('karyawan/{id}/delete', [MasterKaryawanController::class, 'delete'])->name('karyawan.delete');

    Route::resource('menu', MasterMenuController::class);
    Route::get('menu/{id}/delete', [MasterMenuController::class, 'delete'])->name('menu.delete');

    Route::resource('user', UserController::class);
    Route::get('user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');

    // cabang situmpur

    //cs
    Route::get('situmpur/cs', [SitumpurController::class, 'cs'])->name('situmpur.cs');
    Route::get('situmpur/antrian/cs', [SitumpurController::class, 'antrianCs'])->name('situmpur.antrian.cs');
    Route::get('situmpur/antrian/cs/nomor', [SitumpurController::class, 'antrianCsNomor'])->name('situmpur.antrian.cs.nomor');
    Route::get('situmpur/antrian/cs/{nomor}/panggil', [SitumpurController::class, 'antrianCsPanggil'])->name('situmpur.antrian.cs.panggil');
    Route::get('situmpur/antrian/cs/{nomor}/mulai', [SitumpurController::class, 'antrianCsMulai'])->name('situmpur.antrian.cs.mulai');
    Route::get('situmpur/antrian/cs/{nomor}/selesai', [SitumpurController::class, 'antrianCsSelesai'])->name('situmpur.antrian.cs.selesai');

    // desain 
    Route::get('situmpur/antrian/desain', [SitumpurController::class, 'desain'])->name('situmpur.antrian.desain');
    Route::get('situmpur/antrian/desain/{id}/on', [SitumpurController::class, 'desainOn'])->name('situmpur.antrian.desain.on');
    Route::get('situmpur/antrian/desain/{id}/off', [SitumpurController::class, 'desainOff'])->name('situmpur.antrian.desain.off');
    Route::get('situmpur/antrian/desain/nomor', [SitumpurController::class, 'desainNomor'])->name('situmpur.antrian.desain.nomor');
    Route::get('situmpur/antrian/desain/{nomor}/panggil', [SitumpurController::class, 'desainPanggil'])->name('situmpur.antrian.desain.panggil');
    Route::get('situmpur/antrian/desain/{nomor}/desain', [SitumpurController::class, 'desainUpdateDesain'])->name('situmpur.antrian.desain.updatedesain');
    Route::get('situmpur/antrian/desain/{nomor}/edit', [SitumpurController::class, 'desainUpdateEdit'])->name('situmpur.antrian.desain.updateedit');
    Route::get('situmpur/antrian/desain/{nomor}/mulai', [SitumpurController::class, 'desainMulai'])->name('situmpur.antrian.desain.mulai');
    Route::get('situmpur/antrian/desain/{nomor}/selesai', [SitumpurController::class, 'desainSelesai'])->name('situmpur.antrian.desain.selesai');

    // customer 
    Route::get('situmpur/customer', [SitumpurController::class, 'customer'])->name('situmpur.customer');
});

Route::get('situmpur/antrian/customer', [SitumpurController::class, 'antrianCustomer'])->name('situmpur.antrian.customer');
Route::post('situmpur/antrian/customer/search', [SitumpurController::class, 'antrianCustomerSearch'])->name('situmpur.antrian.customer.search');
Route::post('situmpur/antrian/customer/store', [SitumpurController::class, 'antrianCustomerStore'])->name('situmpur.antrian.customer.store');
Route::get('situmpur/antrian/customer/nomor', [SitumpurController::class, 'antrianCustomerNomor'])->name('situmpur.antrian.customer.nomor');
Route::post('situmpur/antrian/customer/sender', [SitumpurController::class, 'antrianCustomerSender'])->name('situmpur.antrian.customer.sender');
Route::get('situmpur/antrian/customer/{id}/form', [SitumpurController::class, 'antrianCustomerForm'])->name('situmpur.antrian.customer.form');

Route::get('situmpur/antrian/display', [SitumpurController::class, 'antrianDisplay'])->name('situmpur.antrian.display');
