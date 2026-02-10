<?php

use App\Http\Controllers\Admin\AdminInterviewController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// Public routes - accessible without authentication
Route::get('/', [HomeController::class, 'index'])->name('home');

// IMPORTANT: Define /jobs/create BEFORE /jobs/{job} to avoid route conflicts
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Authentication routes (Breeze / default)
require __DIR__.'/auth.php';

// Authenticated user routes - protected by auth middleware
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User dashboard & related pages
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/applications', [UserDashboardController::class, 'applications'])->name('applications');
        Route::get('/saved-jobs', [UserDashboardController::class, 'savedJobs'])->name('saved-jobs');
        Route::post('/saved-jobs/{job}', [UserDashboardController::class, 'saveJob'])->name('saved-jobs.save');
        Route::delete('/saved-jobs/{job}', [UserDashboardController::class, 'removeSavedJob'])->name('saved-jobs.remove');
        Route::get('/resume', [UserDashboardController::class, 'resume'])->name('resume');
        Route::get('/job-alerts', [UserDashboardController::class, 'jobAlerts'])->name('job-alerts');
    });

    // User interviews (CRUD)
    Route::prefix('user/interviews')->name('user.interviews.')->group(function () {
        Route::get('/', [InterviewController::class, 'index'])->name('index');
        Route::get('/create', [InterviewController::class, 'create'])->name('create');
        Route::post('/', [InterviewController::class, 'store'])->name('store');
        Route::get('/{interview}', [InterviewController::class, 'show'])->name('show');
        Route::get('/{interview}/edit', [InterviewController::class, 'edit'])->name('edit');
        Route::put('/{interview}', [InterviewController::class, 'update'])->name('update');
        Route::delete('/{interview}', [InterviewController::class, 'destroy'])->name('destroy');
    });

    // Authenticated job actions (post/edit/delete) - protected by auth middleware
    // Note: /jobs/create is already defined above for public access
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

// Admin area – protected by auth + admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Admin Jobs Management (CRUD)
    Route::resource('jobs', AdminJobController::class);
    Route::post('jobs/{job}/extend-deadline', [AdminJobController::class, 'extendDeadline'])->name('jobs.extend-deadline');

    // Admin Users Management (CRUD)
    Route::resource('users', UserController::class);

    // Admin Interviews Management (CRUD)
    Route::get('/interviews', [AdminInterviewController::class, 'index'])->name('interviews.index');
    Route::get('/interviews/create', [AdminInterviewController::class, 'create'])->name('interviews.create');
    Route::post('/interviews', [AdminInterviewController::class, 'store'])->name('interviews.store');
    Route::get('/interviews/{interview}', [AdminInterviewController::class, 'show'])->name('interviews.show');
    Route::get('/interviews/{interview}/edit', [AdminInterviewController::class, 'edit'])->name('interviews.edit');
    Route::put('/interviews/{interview}', [AdminInterviewController::class, 'update'])->name('interviews.update');
    Route::delete('/interviews/{interview}', [AdminInterviewController::class, 'destroy'])->name('interviews.destroy');

    // Reports & Settings
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});