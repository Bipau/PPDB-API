<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//post
Route::apiResource('/post',PostController::class)->names([
    'index'=>'post.index',
    'store' => 'post.'
]);