<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SaaSRegistrationController extends Controller
{
    public function showForm()
    {
       
        return view('register-company');
    }

    public function register(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'subdomain' => 'required|string|max:50|unique:companies,subdomain',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'owner'
        ]);

        Auth::login($user);

        $company = Company::create([
            'name' => $request->company_name,
            'subdomain' => $request->subdomain,
            'tariff' => 'free',
            'user_id' => $user->id,
        ]);

         $dashboardUrl = "http://{$company->subdomain}.l-platform.test/dashboard";

        
        return redirect()->to($dashboardUrl)
                         ->with('success', "Компания {$company->name} успешно создана!");


    }
}
