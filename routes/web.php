<?php

use App\Http\Controllers\DataSiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Usercontroller;

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

Route::get('/', [LandingPageController::class, 'index'])->name('landing_page');


Route::prefix('/siswa')->name('siswa.')->group(function () {
    Route::get('/data', [DataSiswaController::class, 'index'])->name('data');
    Route::get('/tambah', [DataSiswaController::class, 'create'])->name('tambah');
    Route::post('/tambah', [DataSiswaController::class, 'store'])->name('tambah.formulir');
    Route::delete('/hapus/{id}', [DataSiswaController::class, 'destroy'])->name('hapus');
    Route::get('/edit/{id}', [DataSiswaController::class, 'edit'])->name('edit');
    Route::patch('/edit/{id}', [DataSiswaController::class, 'update'])->name('edit.formulir');
    Route::get('/siswa/export', [DataSiswaController::class, 'exportExcel'])->name('export');

});

Route::prefix('user')->name('user.')->group(function () { //path awalan yang akan di akses oleh pengguna
    Route::get('/data', [Usercontroller::class, 'index'])->name('data'); //mengambill data atau menampilkan halaman web
    Route::get('/tambah', [Usercontroller::class, 'create'])->name('tambah');
    Route::post('/tambah', [Usercontroller::class,'store'])->name('tambah.formulir'); // unntuk mengirim data ke server dan menyimpan inputan baru ke database
    Route::delete('/hapus/{id}', [Usercontroller::class, 'destroy'])->name('hapus'); // menghapus database berdasarkan id
    Route::get('/edit/{id}', [Usercontroller::class, 'edit'])->name('edit');
    Route::patch('/edit/{id}', [Usercontroller::class, 'update'])->name('edit.formulir'); // untuk mengubah sebagian data
    Route::patch('edit/stock/{id}', [Usercontroller::class, 'updateStock'])->name('edit.stok');
    Route::get('/user/export', [UserController::class, 'exportExcel'])->name('export');

});
