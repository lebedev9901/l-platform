<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('saas.employees.login'); // форма для PIN
    }

    public function login(Request $request)
    {
        $credentaials = $request->only('email', 'password');

        if(Auth::guard('employee')->attempt($credentaials)){
           $request->session()->generate();
           $company = app('currentCompany');
           return redirect()->to("http://{$company->subdomain}.l-platform.test/dashboard"); 
        }
        $request->validate([
            'pin_code' => 'required'
        ]);

        $employee = Employee::where('pin_code', $request->pin_code)->first();

        if (!$employee) {
            return back()->withErrors(['pin_code' => 'Неверный PIN']);
        }
   
        auth('employee')->login($employee); // авторизация через отдельный guard

        return redirect()->route('employee.dashboard');
    }

    public function logout(Request $request)
    {
        auth('employee')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('employee.login');
    }
}