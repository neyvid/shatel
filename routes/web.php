<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routesf
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
//Route::post('/adsl/support/check', [\App\Http\Controllers\Front\AdslCheck::class, 'adslSupportCheck'])->name('adsl.support.check');
Route::get('/adsl/support/getProvinces', [\App\Http\Controllers\Front\AdslCheck::class, 'getProvinces'])->name('adsl.support.check.getProvinces');
Route::get('resetSession', [\App\Http\Controllers\Front\AdslCheck::class, 'resetSession'])->name('adslCheck.resetSession');
Route::get('/adsl/support/getCititesOfProvince/{id}', [\App\Http\Controllers\Front\AdslCheck::class, 'getCitiesOfProvince'])->name('adsl.support.check.getCitiesOfProvince');
Route::post('/adsl/buy/online', [\App\Http\Controllers\Front\BuyOnlineAdslController::class, 'buyOnline'])->name('adsl.buy.online.first');
Route::get('/adsl/buy/online/get/session', [\App\Http\Controllers\Front\BuyOnlineAdslController::class, 'getOrderDetailsSession'])->name('adsl.buy.online.getOrderDetailsSession');
Route::get('/adsl/buy/online/cancel', [\App\Http\Controllers\Front\BuyOnlineAdslController::class, 'cancelPurchase'])->name('adsl.cancel.purchase');
Route::get('/order/verifyPayment', [\App\Http\Controllers\Front\OrderController::class, 'verifyPayment'])->name('verifyPayment');
Route::post('/adslRegister/save/order', [\App\Http\Controllers\Front\OrderController::class, 'create'])->name('order.create');
Route::post('/adslRegister/save/check', [\App\Http\Controllers\Front\OrderController::class, 'isExistMobileOrEmailCheck'])->name('order.create.check');
//For Create Role and Permission and Assign Role And Permission
//Route::get('/create/role', [\App\Http\Controllers\Admin\CreateRolePermission::class, 'CreateRole']);
//Route::get('/create/permission', [\App\Http\Controllers\Admin\CreateRolePermission::class, 'CreatePermission']);
//Route::get('/create/assignPermissionToRole', [\App\Http\Controllers\Admin\CreateRolePermission::class, 'assignPermissionToRole']);
//Route::get('/create/assingRoleToUser', [\App\Http\Controllers\Admin\CreateRolePermission::class, 'assingRoleToUser']);
//Route::get('/create/assignPermissionToUser', [\App\Http\Controllers\Admin\CreateRolePermission::class, 'assignPermissionToUser']);
Route::get('/menus/all', [\App\Http\Controllers\Front\MenuController::class, 'all'])->name('menus.all');
Route::get('/sliders', [\App\Http\Controllers\Front\SliderController::class, 'all'])->name('slider.all');

//Admin
Route::prefix('admin')->group(function () {
    Route::get('/provinces', [App\Http\Controllers\Admin\ProvinceController::class, 'all'])->name('provinces');
    Route::get('/provinces/edit/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'edit'])->name('provinces.edit.show');
    Route::post('/provinces/edit/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'update'])->name('provinces.update');
    Route::get('/provinces/delete/{id}', [App\Http\Controllers\Admin\ProvinceController::class, 'delete'])->name('provinces.delete');
    Route::post('/provinces/create', [App\Http\Controllers\Admin\ProvinceController::class, 'create'])->name('provinces.create');
    Route::post('/province/import', [App\Http\Controllers\Admin\ProvinceController::class, 'import'])->name('provinces.provinces.import');

    Route::get('/cities', [App\Http\Controllers\Admin\CityController::class, 'all'])->name('cities');
    Route::post('/cities/create', [App\Http\Controllers\Admin\CityController::class, 'create'])->name('cities.create');
    Route::get('/city/edit/{id}', [App\Http\Controllers\Admin\CityController::class, 'edit'])->name('cities.edit.show');
    Route::post('/city/edit/{id}', [App\Http\Controllers\Admin\CityController::class, 'update'])->name('cities.edit.update');
    Route::post('/city/import', [\App\Http\Controllers\Admin\CityController::class, 'import'])->name('panel.cities.import');


    Route::get('/city/delete/{id}', [App\Http\Controllers\Admin\CityController::class, 'delete'])->name('cities.delete');

    Route::get('/telecomcenters', [App\Http\Controllers\Admin\TelecomCenterController::class, 'all'])->name('TelecomCenters');
    Route::post('/telecomcenter/create', [App\Http\Controllers\Admin\TelecomCenterController::class, 'create'])->name('TelecomCenters.create');
    Route::get('/telecomcenter/delete/{id}', [App\Http\Controllers\Admin\TelecomCenterController::class, 'delete'])->name('TelecomCenters.delete');
    Route::get('/telecomcenter/edit/{id}', [App\Http\Controllers\Admin\TelecomCenterController::class, 'edit'])->name('TelecomCenters.edit.show');
    Route::post('/telecomcenter/edit/{id}', [App\Http\Controllers\Admin\TelecomCenterController::class, 'update'])->name('TelecomCenters.edit.update');
    Route::get('/areacodes', [App\Http\Controllers\Admin\AreacodeController::class, 'all'])->name('areacodes');
    Route::get('/areacode/getInfo', [App\Http\Controllers\Admin\AreacodeController::class, 'getInfoForCreateItem'])->name('areacodes.getInfoForCreateItem');
    Route::post('/areacode/creaet', [App\Http\Controllers\Admin\AreacodeController::class, 'create'])->name('areacodes.create');
    Route::get('/areacode/delete/{id}', [App\Http\Controllers\Admin\AreacodeController::class, 'delete'])->name('areacode.delete');
    Route::get('/areacode/edit/{id}', [App\Http\Controllers\Admin\AreacodeController::class, 'edit'])->name('areacode.edit.show');
    Route::post('/areacode/edit/{id}', [App\Http\Controllers\Admin\AreacodeController::class, 'update'])->name('areacode.edit.update');


    Route::get('/codes', [App\Http\Controllers\Admin\CodeController::class, 'all'])->name('codes');
    Route::post('/code/create', [App\Http\Controllers\Admin\CodeController::class, 'create'])->name('code.create');
    Route::post('/code/import', [\App\Http\Controllers\Admin\CodeController::class, 'import'])->name('panel.codes.import');


    Route::get('/oprators', [App\Http\Controllers\Admin\OpratorController::class, 'all'])->name('oprators');
    Route::get('/oprator/delete/{id}', [App\Http\Controllers\Admin\OpratorController::class, 'delete'])->name('oprators.delete');
    Route::post('/oprator/create', [App\Http\Controllers\Admin\OpratorController::class, 'create'])->name('oprators.create');
    Route::get('/oprator/edit/{id}', [App\Http\Controllers\Admin\OpratorController::class, 'edit'])->name('oprators.edit.show');
    Route::post('/oprator/edit/{id}', [App\Http\Controllers\Admin\OpratorController::class, 'update'])->name('oprators.edit.update');
    Route::get('/services', [App\Http\Controllers\Admin\ServiceController::class, 'all'])->name('services');
    Route::post('/service/create', [App\Http\Controllers\Admin\ServiceController::class, 'create'])->name('service.create');
    Route::get('/service/delete/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'delete'])->name('service.delete');
    Route::get('/service/edit/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'edit'])->name('service.edit.show');
    Route::post('/service/edit/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'update'])->name('service.edit.update');
    Route::post('/service/import', [\App\Http\Controllers\Admin\ServiceController::class, 'import'])->name('panel.service.import');

    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class, 'all'])->name('categories');
    Route::post('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
    Route::get('/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit.show');
    Route::post('/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.edit.update');
    Route::get('/category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'all'])->name('products');
    Route::post('/product/create', [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('product.edit.show');
    Route::post('/product/edit/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('product.edit.update');
    Route::get('/product/delete/{id}', [App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('product.delete');
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'all'])->name('orders');
    Route::get('/order/detail/{id}', [App\Http\Controllers\Admin\OrderController::class, 'orderDetail'])->name('orders.detail');
    Route::get('/order/createDialog/show', [App\Http\Controllers\Admin\OrderController::class, 'getDataForCreateNewOrder'])->name('orders.create.show');
    Route::post('/order/create', [App\Http\Controllers\Admin\OrderController::class, 'create'])->name('orders.create');
    Route::get('/order/edit/{id}', [App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('orders.edit.show');

    Route::post('/telecomcenter/delete/all', [App\Http\Controllers\Admin\TelecomCenterController::class, 'deleteAll'])->name('TelecomCenters.deleteAll');
    Route::post('/order/import', [\App\Http\Controllers\Admin\OrderController::class, 'import'])->name('panel.orders.import');

    Route::get('/menus', [App\Http\Controllers\Admin\MenusController::class, 'all'])->name('menus');
    Route::post('/menu/create', [App\Http\Controllers\Admin\MenusController::class, 'create'])->name('menu.create');
    Route::get('/menu/edit/{id}', [App\Http\Controllers\Admin\MenusController::class, 'edit'])->name('menu.edit.show');
    Route::post('/menu/edit/{id}', [App\Http\Controllers\Admin\MenusController::class, 'update'])->name('menu.update');
    Route::get('/menu/delete/{id}', [App\Http\Controllers\Admin\MenusController::class, 'delete'])->name('menu.delete');

    Route::get('/sliders', [App\Http\Controllers\Admin\SliderController::class, 'all'])->name('sliders');
    Route::post('/slider/create', [App\Http\Controllers\Admin\SliderController::class, 'create'])->name('slider.create');
    Route::get('/slider/edit/{id}', [App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('slider.edit.show');
    Route::post('/slider/edit/{id}', [App\Http\Controllers\Admin\SliderController::class, 'update'])->name('slider.update');
    Route::get('/slider/delete/{id}', [App\Http\Controllers\Admin\SliderController::class, 'delete'])->name('slider.delete');

    Route::get('/news', [App\Http\Controllers\Admin\NewsController::class, 'all'])->name('news');
    Route::post('/news/create', [App\Http\Controllers\Admin\NewsController::class, 'create'])->name('news.create');

});
//User panel
Route::prefix('panel')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\Panel\OrderController::class, 'all'])->name('panel.order.all');
    Route::get('/order/detail/{id}', [\App\Http\Controllers\Panel\OrderController::class, 'orderDetail'])->name('panel.orders.detail');

});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');sh
