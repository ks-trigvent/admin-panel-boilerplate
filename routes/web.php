<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/registration', function () {
    return view('auth.registration');
})->name('auth.registration');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('auth.user.login');
    Route::post('/registration', 'registration')->name('auth.user.register');
});


Route::middleware(['isUserLoggedIn'])->controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
    
});

Route::middleware(['isUserLoggedIn'])->group(function () {
    // Routes for DashboardController
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/edit-user/{id}', 'edit')->name('edit.user');
        Route::get('/update-user/{id}', 'update')->name('update.user');
    });

    // Routes for AuthController
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('auth.user.logout');
    });

});

