<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UbigeoController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'view'])->name('home');
Route::get('registro', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'login']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('signup', [AuthController::class, 'signup'])->name('signup');
Route::post('signin', [AuthController::class, 'signin'])->name('signin');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('register-newsletter', [HomeController::class, 'registerToNewsLetter'])->name('registernews');
Route::post('filters', [StoreController::class, 'filters'])->name('filter');
Route::post('contact-form', [ContactController::class, 'contact'])->name('contact');
Route::post('add-cart', [StoreController::class, 'addCart'])->name('add_cart');
Route::get('remove-cart/{uuid}', [StoreController::class, 'removeCart']);
Route::get('checkout', [StoreController::class, 'checkout']);
Route::post('checkout-process', [StoreController::class, 'checkoutAction'])->name('checkout_process');

Route::prefix('store')->group(function(){
    Route::get('{section}', [StoreController::class, 'category']);
    Route::get('{section}/{slug}', [StoreController::class, 'detail']);

});

Route::get('contact', [ContactController::class, 'view']);
Route::get('us', [ContactController::class, 'us']);
Route::get('profile', [AuthController::class, 'profile']);
Route::get('profile/change-password', [AuthController::class, 'changePassword']);
Route::get('profile/change-address', [AuthController::class, 'changeAddress']);

Route::post('forgot-password', [AuthController::class, 'sendEmailRecoveryPassword'])->name('sendEmailRecoveryPassword');
Route::post('change-password', [AuthController::class, 'changePasswordForm'])->name('changePasswordForm');
Route::post('change-address', [AuthController::class, 'changeAddressForm'])->name('changeAddressForm');


Route::get('ubigeo/provincias/{ubigeo}', [UbigeoController::class, 'getProvincias'])->name('getProvincias');
Route::get('ubigeo/distritos/{ubigeo}', [UbigeoController::class, 'getDistritos'])->name('getDistritos');
