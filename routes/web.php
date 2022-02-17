<?php

use Illuminate\Support\Facades\Route;

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

Route::fallback(function () {
    return view('home');
});


//Auth::routes(['verify' => true]);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/password/reset/{token}', function () {
    return view('home');
})->name('password.reset');
Route::post('/mobileVerify/resend', [App\Http\Controllers\Auth\MobileVerificationController::class, 'resend'])->name('mobile.verify.resend');
Route::post('/mobile/verify/{hash}', [App\Http\Controllers\Auth\MobileVerificationController::class, 'verify'])->name('mobile.verify');
Route::post('/adsl/support/check', [\App\Http\Controllers\Front\AdslCheck::class, 'adslSupportCheck'])->name('adsl.support.check');
Route::get('/adsl/support/getProvinces', [\App\Http\Controllers\Front\AdslCheck::class, 'getProvinces'])->name('adsl.support.check.getProvinces');
Route::get('/adsl/support/getCititesOfProvince/{id}', [\App\Http\Controllers\Front\AdslCheck::class, 'getCitiesOfProvince'])->name('adsl.support.check.getCitiesOfProvince');


//Admin
Route::prefix('admin')->group(function (){
    Route::get('/provinces', [App\Http\Controllers\Admin\ProvinceController::class, 'all'])->name('provinces');
    Route::get('/provinces/edit/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'edit'])->name('provinces.edit.show');
    Route::post('/provinces/edit/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'update'])->name('provinces.update');
    Route::get('/provinces/delete/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'delete'])->name('provinces.delete');
    Route::post('/provinces/create', [App\Http\Controllers\Admin\ProvinceController::class, 'create'])->name('provinces.create');
    Route::get('/cities', [App\Http\Controllers\Admin\CityController::class, 'all'])->name('cities');
    Route::post('/cities/create', [App\Http\Controllers\Admin\CityController::class, 'create'])->name('cities.create');
    Route::get('/city/edit/{id}', [App\Http\Controllers\Admin\CityController::class, 'edit'])->name('cities.edit.show');
    Route::post('/city/edit/{id}', [App\Http\Controllers\Admin\CityController::class, 'update'])->name('cities.edit.update');


    Route::get('/city/delete/{id}', [App\Http\Controllers\Admin\CityController::class, 'delete'])->name('cities.delete');

    Route::get('/telecomcenters', [App\Http\Controllers\Admin\TelecomCenterController::class, 'all'])->name('TelecomCenters');
    Route::post('/telecomcenter/create', [App\Http\Controllers\Admin\TelecomCenterController::class, 'create'])->name('TelecomCenters.create');
    Route::get('/telecomcenter/delete/{id}', [App\Http\Controllers\Admin\TelecomCenterController::class, 'delete'])->name('TelecomCenters.delete');
    Route::get('/telecomcenter/edit/{id}', [App\Http\Controllers\Admin\TelecomCenterController::class, 'edit'])->name('TelecomCenters.edit.show');
    Route::post('/telecomcenter/edit/{id}', [App\Http\Controllers\Admin\TelecomCenterController::class, 'update'])->name('TelecomCenters.edit.update');
    Route::get('/areacodes', [App\Http\Controllers\Admin\AreacodeController::class, 'all'])->name('areacodes');
    Route::get('/areacode/getInfo', [App\Http\Controllers\Admin\AreacodeController::class, 'getInfoForCreateItem'])->name('areacodes.getInfoForCreateItem');
    Route::post('/areacode/create', [App\Http\Controllers\Admin\AreacodeController::class, 'create'])->name('areacodes.create');
    Route::get('/areacode/delete/{id}', [App\Http\Controllers\Admin\AreacodeController::class, 'delete'])->name('areacode.delete');
    Route::get('/areacode/edit/{id}', [App\Http\Controllers\Admin\AreacodeController::class, 'edit'])->name('areacode.edit.show');
    Route::post('/areacode/edit/{id}', [App\Http\Controllers\Admin\AreacodeController::class, 'update'])->name('areacode.edit.update');

    Route::post('/telecomcenter/delete/all', [App\Http\Controllers\Admin\TelecomCenterController::class, 'deleteAll'])->name('TelecomCenters.deleteAll');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');sh
