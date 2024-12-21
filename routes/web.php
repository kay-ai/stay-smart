<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Support\Facades\Auth;
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

Route::controller(PagesController::class)->group(function(){
    Route::get('/', 'welcome')->name('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::controller(BookingsController::class)->group(function () {
        Route::get('/my_bookings','mine')->name('booking.mine');
        Route::get('/book/property/{property}','book')->name('booking.book');
        Route::post('/booking/store','store')->name('booking.store');
        Route::get('/booking/view/{reference}','view')->name('booking.view');
    });

    Route::controller(PagesController::class)->group(function () {
        Route::get('/services', 'services')->name('service.index');
    });

    Route::controller(PaymentsController::class)->group(function () {
        Route::get('/payments', 'index')->name('payment.index');
    });
});
