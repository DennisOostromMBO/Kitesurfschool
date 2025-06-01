<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Instructor routes
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors.index');
    Route::delete('/instructors/{id}', [InstructorController::class, 'destroy'])->name('instructors.destroy');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Purchase route
    Route::post('/packages/{id}/purchase', [PackageController::class, 'purchase'])
        ->middleware(['auth'])
        ->name('packages.purchase');

    // Cancel route
    Route::delete('/packages/{id}/cancel', [PackageController::class, 'cancel'])
        ->middleware(['auth'])
        ->name('packages.cancel');

    // User management routes (owner only)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/role', [UserController::class, 'updateRole'])->name('users.update-role');

    Route::post('/packages/{id}/reject', [PackageController::class, 'reject'])
        ->name('packages.reject');
    Route::post('/package-rejections/{id}/handle', [PackageController::class, 'handleRejection'])
        ->name('rejections.handle');

    // Lesson routes
    Route::post('/lessons/{id}/cancel-email', [LessonController::class, 'sendCancellationEmail'])
        ->name('lessons.cancel-email')
        ->middleware(['auth']);
});

// Password reset routes
Route::get('/set-password/{token}', [PasswordController::class, 'showSetPasswordForm'])
    ->name('password.show');
Route::post('/set-password', [PasswordController::class, 'setPassword'])
    ->name('password.store');

// Email verification notice
Route::get('/email/verify-notice', function () {
    return view('auth.verify-notice');
})->name('verification.notice');
