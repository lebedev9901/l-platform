<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeNotificationController;
use App\Http\Controllers\EmployeeTaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaaSRegistrationController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Главный домен (лендинг + регистрация компании)
|--------------------------------------------------------------------------
*/
 Route::domain('l-platform.test')->group(function () {

    // Лендинг
    Route::view('/', 'pages.home')->name('home');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/features', 'pages.features')->name('features');
    Route::view('/contacts', 'pages.contacts')->name('contacts');
    Route::view('/privacy', 'pages.privacy')->name('privacy');
    Route::view('/create', 'pages.create')->name('create');

    // Регистрация компании
    Route::get('/register-company', [SaaSRegistrationController::class, 'showForm'])->name('register.company');
    Route::post('/register-company', [SaaSRegistrationController::class, 'register']);
});


/*
|--------------------------------------------------------------------------
| Поддомены компаний (SaaS multi-tenant)
|--------------------------------------------------------------------------
*/
Route::domain('{company}.l-platform.test')
    ->middleware(['identify.company']) // подключаем middleware для текущей компании
    ->group(function () {

        // Гостевой доступ (логин сотрудников)
        Route::middleware('guest:employee')->group(function () {
            Route::get('/login', [EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
            Route::post('/login', [EmployeeAuthController::class, 'login']);
        });

        // Авторизованные сотрудники
        Route::middleware('auth')->group(function () {

            // Логаут
            Route::post('/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');

            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // -------------------------
            // Задачи
            // -------------------------
            Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
            Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
            Route::put('/tasks/{id}', [TaskController::class, 'update']);
            Route::get('/tasks/{id}', [TaskController::class, 'show']);
           
            // -------------------------
            // Сотрудники
            // -------------------------
            Route::get('/employees', [EmployeeController::class, 'index'])->name('employees');
            Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
            Route::post('/employees', [EmployeeController::class, 'store']);
            Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit']);
            Route::put('/employees/{employee}', [EmployeeController::class, 'update']);
            Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);

            // -------------------------
            // Уведомления и KPI
            // -------------------------
            Route::get('/employees/notifications', [EmployeeNotificationController::class, 'index']);
            Route::get('/employees/kpi', [EmployeeNotificationController::class, 'kpi']);

            // -------------------------
            // Профиль
            // -------------------------
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
});

// fallback для любого неправильного URL
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});