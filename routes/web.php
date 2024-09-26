<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::check()){
        return redirect('/dashboard');
    }
    return view('auth.login');
})->name('auth.login');

Route::get('/registration', function () {
    return view('auth.registration');
})->name('auth.registration');

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('auth.user.login');
    Route::post('/registration', 'registration')->name('auth.user.register');
    Route::get('/forget/password', 'forgetPassword')->name('auth.user.forget.password');
    Route::post('/forget/password', 'sendUpdatePasswordEmail')->name('auth.user.send.email');
    Route::get('/forget/password/{id}/{token}', 'emailForgetPasswordLink')->name('auth.user.email.forget.link');
    Route::post('/forget/password/{id}/{token}', 'updatePassword')->name('auth.user.update.password');
});

Route::middleware(['isUserLoggedIn'])->group(function () {
    // Routes for DashboardController
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/edit/user/{id}', 'edit')->name('edit.user');
        Route::post('/update/user/{id}', 'update')->name('update.user');
        Route::get('/update/user/profile', 'userProfile')->name('update.user-profile');
        Route::get('/delete/user/{id}', 'deleteUser')->name('delete.user-profile');
    });

    // Routes for AuthController
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('auth.user.logout');
    });

});

