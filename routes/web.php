<?php

use App\Http\Controllers\Frontsite\AppointmentController;
use App\Http\Controllers\Frontsite\LandingController;
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

Route::resource('/', LandingController::class);


Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    // appointment page
    // Route::get('appointment/doctor/{id}', [AppointmentController::class, 'appointment'])->name('appointment.doctor');
    Route::resource('appointment', AppointmentController::class);

    // // payment page
    // Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
    // Route::get('payment/appointment/{id}', [PaymentController::class, 'payment'])->name('payment.appointment');
    // Route::resource('payment', PaymentController::class);

    // Route::resource('register_success', RegisterController::class);
});
