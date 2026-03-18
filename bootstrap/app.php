<?php

use App\Http\Middleware\EmployeeAuth;
use App\Http\Middleware\IdentifyCompany;
use App\Http\Middleware\TenatMiddleware;
use App\Http\Middleware\UpdateLastActivity;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
             $middleware->alias([
            'employee.auth' => EmployeeAuth::class,
            'employee.activity' => UpdateLastActivity::class,
            'identify.company' => IdentifyCompany::class,
    ]);
   
            $middleware->append(IdentifyCompany::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
