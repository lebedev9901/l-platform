<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaaSRegistrationController;
use Illuminate\Support\Facades\Route;


Route::get('/register-company', [SaaSRegistrationController::class, 'showForm']);
Route::post('/register-company', [SaaSRegistrationController::class, 'register']);

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::post('/dashboard/add-user', [DashboardController::class,'addUser'])->name('dashboard.add-user');
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
