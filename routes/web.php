<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FAQController as FrontFAQController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QuestionAnswerController;
use App\Http\Controllers\Admin\ProductMatchController;
use App\Http\Controllers\Admin\FAQController as AdminFAQController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\OrderController as FrontOrderController;

// Front routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/survey/process', [HomeController::class, 'processSurvey'])->name('survey.process');
Route::get('/page/{slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/faqs', [FrontFAQController::class, 'index'])->name('faqs.index');

// Guest routes (only accessible when not logged in)
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // AJAX authentication routes
    Route::post('ajax/login', [LoginController::class, 'ajaxLogin'])->name('ajax.login');
    Route::post('ajax/register', [RegisterController::class, 'ajaxRegister'])->name('ajax.register');
});

// Auth routes (only accessible when logged in)
Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // User account routes
    Route::get('/account', [App\Http\Controllers\Front\UserController::class, 'account'])->name('user.account');
    Route::post('/account', [App\Http\Controllers\Front\UserController::class, 'updateAccount'])->name('user.account.update');
    Route::get('/account/orders', [App\Http\Controllers\Front\OrderController::class, 'index'])->name('user.orders');
    Route::get('/account/orders/{order}', [App\Http\Controllers\Front\OrderController::class, 'show'])->name('user.orders.show');
});

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Admin routes
Route::middleware([ AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Pages management
    Route::resource('pages', AdminPageController::class);

    // FAQs management
    Route::resource('faqs', AdminFAQController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Orders
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'destroy']);

    // Contact messages
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);

    // Users
    Route::resource('users', UserController::class);

    // Questions & Answers
    Route::resource('questions', QuestionAnswerController::class);

    // Product Matches
    Route::resource('product-matches', ProductMatchController::class);
    Route::post('product-matches/generate', [ProductMatchController::class, 'generateCombinations'])->name('product-matches.generate');
});

// Front routes
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Cart routes
Route::get('/cart', [App\Http\Controllers\Front\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [App\Http\Controllers\Front\CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [App\Http\Controllers\Front\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [App\Http\Controllers\Front\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [App\Http\Controllers\Front\CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart-data', [CartController::class, 'getCartData'])->name('cart.data');
// New cart routes for AJAX functionality
Route::get('/cart/get', [CartController::class, 'get'])->name('cart.get');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
Route::post('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove-item');

// Checkout and Order routes
Route::get('/checkout', [App\Http\Controllers\Front\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [App\Http\Controllers\Front\CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/order/success/{order}', [App\Http\Controllers\Front\OrderController::class, 'success'])->name('order.success');
Route::get('/order/failed', [App\Http\Controllers\Front\OrderController::class, 'failed'])->name('order.failed');
