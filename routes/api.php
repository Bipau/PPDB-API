<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PanitiaController;
use App\Http\Controllers\Api\CalonSiswaApiController;
use App\Http\Controllers\Api\CalonSiswaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//post
Route::apiResource('/post',PostController::class);

//panitia
Route::apiResource('/panitia', PanitiaController::class)->names([
    'index' => 'api.panitia.index',
    'store' => 'api.panitia.store',
    'show' => 'api.panitia.show',
    'update' => 'api.panitia.update',
    'destroy' => 'api.panitia.destroy',
]);


Route::apiResource('/pendaftaran', CalonSiswaController::class);