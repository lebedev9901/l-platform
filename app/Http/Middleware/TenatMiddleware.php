<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenatMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // 1. Попробуем получить субдомен
        $host = $request->getHost(); // demo2.l-platform.test или l-platform.test
        $parts = explode('.', $host);

        if (count($parts) >= 3) {
            // Если есть поддомен
            $subdomain = $parts[0];
        } else {
            // Если нет поддомена, берем из GET параметра
            $subdomain = $request->query('company');
        }

        $company = Company::where('subdomain', $subdomain)->first();

        if (!$company) {
            abort(404, "Компания с субдоменом {$subdomain} не найдена");
        }

        app()->instance('company', $company);

        return $next($request);
    }
}
