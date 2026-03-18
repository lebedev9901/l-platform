<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeAuthController;
use App\Http\Controllers\EmployeeController;

use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeeNotificationController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaaSRegistrationController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'pages.home');
Route::view('/about', 'pages.aboute');
Route::view('/features', 'pages.features');
Route::view('/contacts', 'pages.contacts');
Route::view('/privacy', 'pages.privacy');
Route::view('/login', 'pages.login');
Route::view('/create', 'pages.create');

Route::get('/register-company', [SaaSRegistrationController::class, 'showForm'])->name('register.company');
Route::post('/register-company', [SaaSRegistrationController::class, 'register']);

Route::get('/employee/login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
Route::post('/employee/login', [EmployeeAuthController::class, 'login']);
Route::post('/employee/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');

Route::post('/dashboard/add-user', [DashboardController::class,'addUser'])->name('dashboard.add-user');

Route::get('/employees/notifications', [EmployeeNotificationController::class, 'index']);
Route::get('/employees/kpi', [EmployeeNotificationController::class, 'kpi']);

Route::middleware(['employee.auth', 'employee.activity'])->group(function() {
   
    Route::resource('employee', EmployeeController::class);

    Route::get('/employees/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');

    Route::get('/employees/tasks', [EmployeeTaskController::class, 'available'])->name('employees.tasks.available');
    Route::post('/employees/tasks/{task}/take', [EmployeeTaskController::class, 'take'])->name('employee.tasks.take');
    Route::post('/employees/tasks/{task}/complete', [EmployeeTaskController::class, 'complete'])->name('employee.tasks.complete');

    });

Route::middleware('auth')->group(function () {


    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store']);

    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit']);
Route::put('/employees/{employee}', [EmployeeController::class, 'update']);
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
