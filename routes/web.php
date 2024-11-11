<?php

use App\Http\Controllers\adminpusController;
use App\Http\Controllers\adminwilController;
use App\Http\Controllers\redirectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sesiController;
use App\Http\Controllers\usersController;

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
    Route::get('/adminpus', [adminpusController::class, 'index']);
    //manajemen user
    Route::get('/users', [usersController::class, 'index']);
    Route::get('/add-akun', [usersController::class, 'tambah'])->name('add-akun');
    Route::post('/store-akun', [usersController::class, 'store'])->name('store-akun');
    Route::get('/update-akun/{id}', [usersController::class, 'edit'])->name('update-akun');
    Route::post('/proses-akun/{id}', [usersController::class, 'update'])->name('proses-akun');
    Route::delete('/destroy-akun/{id}', [usersController::class, 'destroy'])->name('destroy-akun');
    
    
});

// untuk admin wilayah
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/adminwil', [adminwilController::class, 'index']);
});