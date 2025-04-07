<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

// Front routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/survey/process', [HomeController::class, 'processSurvey'])->name('survey.process');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('pages.show');

// Guest routes (only accessible when not logged in)
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Auth routes (only accessible when logged in)
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Pages management
    Route::resource('pages', AdminPageController::class);

    // Contact messages
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
});

// Front routes
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Include admin routes
require __DIR__.'/admin_routes.php';
