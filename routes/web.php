<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InstructorController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('index');
})->name('welcome');

require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Instructor routes
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/instructors', [InstructorController::class, 'index'])->name('instructors.index');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
