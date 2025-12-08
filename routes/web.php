<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Default route - redirect to login
Route::get('/', function () {
    return redirect()->route('login');
});

// ========== AUTH ROUTES (PUBLIC) ==========
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========== USER ROUTES (PROTECTED) ==========
Route::middleware(['auth'])->group(function () {
    Route::get('/homepage', [App\Http\Controllers\JobController::class, 'homepage'])->name('homepage');
    Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs');
    Route::get('/apply', [App\Http\Controllers\JobController::class, 'showApply'])->name('apply');
    Route::post('/apply', [App\Http\Controllers\JobController::class, 'apply'])->name('apply.submit');
    
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    Route::get('/test', function () {
        return view('user.test');
    })->name('test');

    Route::get('/buildresume', function () {
        return view('user.buildresume');
    })->name('buildresume');
});

// ========== ADMIN ROUTES (PROTECTED) ==========
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('/jobs', function () {
        return view('admin.jobs');
    })->name('admin.jobs');

    Route::get('/questions', function () {
        return view('admin.questions');
    })->name('admin.questions');
});