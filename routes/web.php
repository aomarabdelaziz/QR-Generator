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

Route::get('/' , [\App\Http\Controllers\QrController::class , 'index']);
Route::post('/qr-builder' , [\App\Http\Controllers\QrController::class , 'build'])->name('qr_builder');
Route::get('/phone', [\App\Http\Controllers\QrController::class, 'phone'])->name('qr_phone');
Route::get('/email', [\App\Http\Controllers\QrController::class, 'email'])->name('qr_email');
Route::get('/geo', [\App\Http\Controllers\QrController::class, 'geo'])->name('qr_geo');
Route::get('/sms', [\App\Http\Controllers\QrController::class, 'sms'])->name('qr_sms');
