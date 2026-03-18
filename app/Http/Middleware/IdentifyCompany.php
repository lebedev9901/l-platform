<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class IdentifyCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subdomain = $request->route('company');
        if($subdomain){
        $company = Company::where('subdomain', $subdomain)->first();

        if(!$company){
            abort(404, 'No company');
        }

        app()->instance('currentCompany', $company);

          // 💥 ВОТ ЭТО КЛЮЧ
        URL::defaults([
            'company' => $company->subdomain
        ]);
        $request->merge(['currentCompany' => $company]);
        }else{
            app()->instance('currentCompany', null);
        }
        return $next($request);
    }
}
