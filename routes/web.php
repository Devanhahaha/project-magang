<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortofolioController;
use App\Http\Controllers\Admin\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', function () {
    return view('auth.auth-register-cover');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.auth-forgot-password-cover');
})->middleware('guest')->name('forgot-password');

// ferifikasi email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard')->with('success', 'Email verified successfully!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Tampilkan halaman "check your email"
Route::get('/email/verify', function () {
    return view('auth.auth-verify-email-cover');
})->middleware('auth')->name('verification.notice');

// Kirim ulang link verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/authentication', [AuthController::class, 'authentication'])->name('login.authentication')->middleware('throttle:3,1');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register-authentication', [AuthController::class, 'register'])->name('register.authentication')->middleware('throttle:3,1');

// reset password
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->name('forgot-password.send')->middleware('throttle:3,1');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::prefix('admin')->middleware('role:admin')->group(function () {
    // admin dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // admin profile
    Route::get('/profile', [UserController::class, 'index'])->name('profile');

    // admin home
    Route::resource('home', HomeController::class);

    // admin about
    Route::resource('about', AboutController::class);

    // admin services
    Route::resource('services', ServicesController::class);

    // admin news
    Route::resource('news', NewsController::class);

    // admin portofolio
    Route::resource('portofolio', PortofolioController::class);

    // admin settings
    Route::resource('settings', SettingsController::class);
});