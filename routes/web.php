<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CheckNipController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakePaymentController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\ThankYouController;
use App\Http\Controllers\ValidationPaymentController;
use App\Http\Controllers\ViewUserController;
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

Route::get('/', function () {
    return redirect('home');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/check-nip', CheckNipController::class)->name('check-nip');
    Route::post('/payment', MakePaymentController::class)->name('make-payment');
    Route::any('/validation', ValidationPaymentController::class)->name('validate-payment');
    Route::post('/thank-you', ThankYouController::class)->name('thanks-page');
    Route::post('/change-password', ChangePasswordController::class)->name('change-password');
    Route::resource('opinions', OpinionController::class);
    Route::get('viewusers', ViewUserController::class)->name('viewusers');

    Route::post('/viewusers/edit/{id}', [ViewUserController::class,'edituser'])->name('edituser');
    Route::get('/viewusers/premium/{id}', [ViewUserController::class,'premiumuser'])->name('premiumuser');

});

Auth::routes();


Route::get('/home2', [HomeController::class, 'index'])->name('home');



