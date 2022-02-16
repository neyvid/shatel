<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::patch('/user/update',[\App\Http\Controllers\Admin\UserController::class,'update'])->middleware('auth:sanctum')->name('profile.update');
Route::post('/user/upload',[\App\Http\Controllers\UploadImage::class,'upload'])->middleware('auth:sanctum');
//
//Route::prefix('user')->group(function () {
//    Route::post('/upload', [\App\Http\Controllers\UploadImage::class,'upload']);
//});
