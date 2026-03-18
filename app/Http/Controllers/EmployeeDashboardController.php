<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('employee');
    }
    public function index()
    {
        $employee = auth('employee')->user();

        $tasks = $employee->tasks()->get();

        return view('saas.employees.dashboard', compact('employee', 'tasks'));
    }
}
