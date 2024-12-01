<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalonSiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;



Route::get('/', [DashboardController::class, 'show']);

Route::get('/Profile', [ProfileController::class, 'index']);

//route admin
Route::get('/admin', [AdminController::class, 'index']);

Route::get('laporan', [LaporanController::class, 'index']);


//route data pendaftaran
Route::get('pendaftaran/calonSiswa',[CalonSiswaController::class,'show'])->name('calonSiswa.show');
Route::get('pendaftaran/create',[CalonSiswaController::class,'create'])->name('calonSiswa.create');
Route::post('pendaftaran/store',[CalonSiswaController::class,'store'])->name('calonSiswa.store');
Route::get('pendaftaran/{id}',[CalonSiswaController::class,'view'])->name('calonSiswa.view');
Route::get('pendaftaran/edit/{id}',[CalonSiswaController::class,'edit'])->name('calonSiswa.edit');
Route::delete('pendaftaran/{id}',[CalonSiswaController::class,'destroy'])->name('calonSiswa.destroy');




//route data panitia
Route::prefix('panitia')->group(function () {
    Route::get('index', [PanitiaController::class, 'index'])->name('panitia.index');
    Route::get('create', [PanitiaController::class, 'create'])->name('panitia.create');
    Route::post('store', [PanitiaController::class, 'store'])->name('panitia.store');
    Route::get('{id}', [PanitiaController::class, 'show'])->name('panitia.show');
    Route::get('edit/{id}', [PanitiaController::class, 'edit'])->name('panitia.edit');
    Route::delete('{id}', [PanitiaController::class, 'destroy'])->name('panitia.destroy');
});








//route post
Route::get('post/index',[PostController::class,'index'])->name('post.index');
Route::get('post/create',[PostController::class,'create'])->name('post.create');
Route::post('post/store',[PostController::class,'store'])->name('post.store');
Route::get('post/{post}',[PostController::class,'show'])->name('post.show');
Route::get('post/{post}/edit',[PostController::class,'edit'])->name('post.edit');
Route::put('post/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');



