<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth('employee')->check()){
            auth('employee')->user()->update([
                'last_activity' => now()
            ]);
        }
    
        return $next($request);
    }
}
