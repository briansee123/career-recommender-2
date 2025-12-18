<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PersonalityTestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\AIController; 

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User routes (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    // Homepage & Jobs
    Route::get('/homepage', [JobController::class, 'homepage'])->name('homepage');
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
    Route::get('/apply', [JobController::class, 'showApply'])->name('apply.show');
    Route::post('/apply', [JobController::class, 'apply'])->name('apply.submit');  // ← CHANGED THIS
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/application/{id}', [ProfileController::class, 'deleteApplication'])->name('profile.deleteApplication');
    
    // Resume Management
    Route::post('/profile/upload-resume', [ProfileController::class, 'uploadResume'])->name('profile.uploadResume');
    Route::delete('/profile/resume/file', [ProfileController::class, 'deleteResumeFile'])->name('profile.deleteResumeFile');
    Route::delete('/profile/resume/record', [ProfileController::class, 'deleteResumeRecord'])->name('profile.deleteResumeRecord');
    
    // Personality Test
    Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');
    Route::post('/test', [PersonalityTestController::class, 'submitTest'])->name('test.submit');
    
    // Resume Builder Routes
    Route::get('/buildresume', [ResumeController::class, 'show'])->name('buildresume');
    Route::post('/resume/save', [ResumeController::class, 'save'])->name('resume.save');
    Route::get('/resume/download', [ResumeController::class, 'download'])->name('resume.download');
});

// Admin routes (protected by auth middleware)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Job Management
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
    Route::post('/jobs/create', [AdminController::class, 'createJob'])->name('jobs.create');
    Route::put('/jobs/{id}', [AdminController::class, 'updateJob'])->name('jobs.update');
    Route::delete('/jobs/{id}', [AdminController::class, 'deleteJob'])->name('jobs.delete');
    
    // Question Management
    Route::get('/questions', [App\Http\Controllers\Admin\AdminQuestionController::class, 'index'])->name('questions');
    Route::post('/questions/update', [App\Http\Controllers\Admin\AdminQuestionController::class, 'update'])->name('questions.update');
    Route::post('/questions/store', [App\Http\Controllers\Admin\AdminQuestionController::class, 'store'])->name('questions.store');
    Route::delete('/questions/{id}', [App\Http\Controllers\Admin\AdminQuestionController::class, 'destroy'])->name('questions.destroy');
});

// AI Routes
Route::middleware('auth')->group(function () {
    Route::get('/ai/profile-encouragement', [AIController::class, 'profileEncouragement'])->name('ai.profile');
    Route::post('/ai/chat', [AIController::class, 'chat'])->name('ai.chat');
});
Route::post('/ai/analyze-career-test', [AIController::class, 'analyzeCareerTest'])->name('ai.analyze');
