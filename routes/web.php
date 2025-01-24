<?php

use App\Http\Controllers\adminpusController;
use App\Http\Controllers\adminwilController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\KelDesaController;
use App\Http\Controllers\profilController;
use App\Http\Controllers\redirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sesiController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\KabupatenKotaController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanDesaController;
use App\Http\Controllers\ProvinsiController;

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

//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/login', [sesiController::class, 'index'])->name('login');
    Route::post('/login', [sesiController::class, 'login']);

});

// 
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function() {
    Route::get('/logout', [sesiController::class, 'logout'])->name('logout');
    Route::get('/redirect', [redirectController::class, 'cek']);
});

// untuk admin pusat
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    //dashboard admin pusat
    Route::get('/adminpus', [adminpusController::class, 'index']);

    //manajemen user
    Route::get('/users', [usersController::class, 'index']);
    Route::get('/add-account', [usersController::class, 'add'])->name('add-account');
    Route::post('/store-account', [usersController::class, 'store'])->name('store-account');
    Route::get('/update-account/{id}', [usersController::class, 'update'])->name('update-account');
    Route::post('/process-account/{id}', [usersController::class, 'processupdate'])->name('process-account');
    Route::delete('/destroy-account/{id}', [usersController::class, 'destroy'])->name('destroy-account');
    Route::post('/userchangepw/{id}', [usersController::class, 'userchangepw'])->name('user-change-pw');
   
    //manajemen profil user
    Route::get('/profile', [profilController::class, 'index']);
    Route::get('/add-profile/{id}', [profilController::class, 'add'])->name('add-profile');
    Route::post('/store-PU', [profilController::class, 'storePU'])->name('store-PU');//by admin
    Route::patch('/profile/{id}', [profilController::class, 'update'])->name('update-profile');
    Route::post('/store-profile', [profilController::class, 'store'])->name('store-profile');//by self
    Route::post('/change-password', [profilController::class, 'changePasswordSave'])->name('postChangePassword');
    Route::get('/destroyImg/{id}', [profilController::class, 'destroyImg'])->name('destroyImg');
    Route::patch('/updatePhoto/{id}', [profilController::class, 'updatePhoto'])->name('updatePhoto');

    //manajemen kegiatan
    Route::get('/event', [eventController::class, 'index']);

    // manajemen lembaga
    Route::get('/lembaga', [LembagaController::class, 'index'])->name('lembaga.index');
    Route::get('/lembaga/create', [LembagaController::class, 'create'])->name('lembaga.create');
    Route::post('/lembaga', [LembagaController::class, 'store'])->name('lembaga.store');
    Route::get('/lembaga/{id}/edit', [LembagaController::class, 'edit'])->name('lembaga.edit');
    Route::delete('/lembaga/{id}', [LembagaController::class, 'destroy'])->name('lembaga.destroy');
    Route::patch('/lembaga/{id}', [LembagaController::class, 'update'])->name('lembaga.update');


    // Route resource untuk CRUD Provinsi
    Route::resource('provinsi', ProvinsiController::class);

    // Route Kabupaten Kota
    Route::resource('kab_kota', KabupatenKotaController::class);
    Route::get('/get-kabupaten-kota/{id_provinsi}', [KabupatenKotaController::class, 'getKabKotaByProvinsi'])->name('get-kabupaten-kota');


    // Route Kecamatan
    Route::resource('kecamatan', KecamatanController::class);
    Route::get('/get-kecamatan/{id_kab_kota}', [KecamatanController::class, 'getKecamatanByKabupaten'])->name('get-kecamatan');

    Route::resource('kel_desa', KelurahanDesaController::class);
    Route::get('/get-kelurahan-desa/{id_kecamatan}', [KelurahanDesaController::class, 'getKelDesaByKecamatan'])->name('get-kelurahan-desa');

});

// untuk admin wilayah
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/adminwil', [adminwilController::class, 'index']);
});