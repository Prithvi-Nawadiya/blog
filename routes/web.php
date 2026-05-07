<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/blog/{id}', [FrontendController::class, 'show'])->name('frontend.show');

Route::get('/filter', [BlogController::class, 'filter']);

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');



// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/upload-image', [AdminController::class, 'uploadImage'])->name('upload-image');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [AdminController::class, 'destroy'])->name('destroy');
});

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::get('/blogs/{id}', [BlogController::class, 'show']);
    Route::put('/blogs/{id}', [BlogController::class, 'update']);
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);
});
