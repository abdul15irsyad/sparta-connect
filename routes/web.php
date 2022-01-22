<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
// admin
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/', function () {
    return redirect()->route('home');
});

Route::middleware(['auth'])->group(function () {
    // home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // auth
    Route::prefix('auth')->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware(['guest'])->group(function () {
    // auth
    Route::prefix('auth')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/login', [AuthController::class, 'login_process'])->name('login');
        Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('forgot-password');
        Route::post('/forgot-password', [AuthController::class, 'forgot_password_process'])->name('forgot-password');
        Route::get('/reset-password', [AuthController::class, 'reset_password'])->name('reset-password');
        Route::post('/reset-password', [AuthController::class, 'reset_password_process'])->name('reset-password');
    });
});

Route::prefix('admin')->group(function () {
    // not authenticated
    Route::middleware(['admin.guest'])->group(function () {
        // auth
        Route::prefix('auth')->group(function () {
            Route::get('/login', [AdminAuthController::class, 'login'])->name('admin-login');
            Route::post('/login', [AdminAuthController::class, 'login_process'])->name('admin-login');
            Route::get('/forgot-password', [AdminAuthController::class, 'forgot_password'])->name('admin-forgot-password');
            Route::post('/forgot-password', [AdminAuthController::class, 'forgot_password_process'])->name('admin-forgot-password-process');
            Route::get('/reset-password', [AdminAuthController::class, 'reset_password'])->name('admin-reset-password');
            Route::post('/reset-password', [AdminAuthController::class, 'reset_password_process'])->name('admin-reset-password-process');
        });
    });

    Route::middleware(['admin.auth'])->group(function () {
        // dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
        });
        // auth
        Route::prefix('auth')->group(function () {
            Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin-logout');
        });
    });
});
