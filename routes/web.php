<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\ChefServiceController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PermissionAssignmentController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoleAssignmentController;
use App\Http\Controllers\RolesController;
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

    Route::controller(PropertyController::class)->group(function () {
        Route::get('/apartments', 'index')->name('apartments.index');
        Route::get('/apartments/check-in', 'checkIn')->name('apartments.checkIn');
        Route::get('/apartments/create', 'create')->name('apartments.create');
        Route::post('/apartments', 'store')->name('apartments.store');
        Route::get('/apartments/all', 'allApartments')->name('apartments.all');
        Route::post('/apartments/{id}/mark-available', 'markAsAvailable')->name('apartments.markAvailable');
    });

    Route::controller(ChefController::class)->group(function () {
        Route::get('/chefs', 'index')->name('chefs.index');
        Route::get('/chefs/create', 'create')->name('chefs.create');
        Route::post('/chefs', 'store')->name('chefs.store');
        Route::delete('/chefs/{chef}', 'destroy')->name('chefs.destroy');
        Route::get('/chefs/{chef}/services', 'getServices')->name('chefs.services');
        Route::get('/chefs/book', 'book')->name('chefs.book');
        Route::post('/chefs/book', 'storeBooking')->name('chefs.book.store');
        Route::post('/chefs/{chef}/mark-available', 'markAsAvailable')->name('chefs.markAvailable');
    });

    Route::controller(ChefServiceController::class)->group(function () {
        Route::get('/chef-service', 'index')->name('chef.service.index');
        Route::post('/chef-service', 'store')->name('chef.service.store');
        Route::post('/chef-service/assign', 'assignService')->name('chef.service.assign');
    });

    Route::controller(PaymentsController::class)->group(function () {
        Route::get('/payments', 'index')->name('payment.index');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::post('/update-profile', 'updateProfile')->name('update.profile');
        Route::post('/update-password', 'updatePassword')->name('update.password');
    });

    Route::resources([
        'roles' => RolesController::class,
        'permissions' => PermissionsController::class,
        'role-assignment' => RoleAssignmentController::class,
        'permission-assignment' => PermissionAssignmentController::class
    ]);

    Route::post('/role-permissions/{role}', [RolesController::class, 'getPermissions']);
});
