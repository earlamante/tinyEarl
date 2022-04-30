<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use \App\Http\Controllers\UrlsController;

Route::get('/', [UrlsController::class, 'index']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::middleware('auth')->group(function() {
    Route::get('dashboard', [UrlsController::class, 'dashboard']);
    Route::post('add_new', [UrlsController::class, 'add_new'])->name('dashboard.add_new');
    Route::post('delete/{id}', [UrlsController::class, 'destroy'])->name('dashboard.delete');
});

Route::get('{any}', [UrlsController::class, 'redirect']);
