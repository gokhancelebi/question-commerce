<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QuestionAnswerController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit', 'destroy']);
    Route::resource('contacts', ContactController::class)->except(['create', 'store', 'show']);
    Route::resource('users', UserController::class);
    Route::resource('questions', QuestionAnswerController::class);
});
