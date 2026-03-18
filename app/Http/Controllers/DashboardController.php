<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $company = Company::first();

        $totalEmployees = $company ? $company->employees()->count() : 0;
        $totalTasks = $company ? $company->tasks()->count() : 0;
        // $employees = $company ? $company->employees : collect();
        
        $tasksNew = $company ? $company->tasks()->where('status', 'new')->count() : 0;
        $tasksInProgress = $company ? $company->tasks()->where('status', 'in_progress')->count() : 0;
        $tasksDone = $company ? $company->tasks()->where('status', 'done')->count() : 0;        
        return view('saas.dashboard', compact(
            'totalEmployees',
            'totalTasks',
            'tasksNew',
            'tasksInProgress',
            'tasksDone'
            ));
    }

     public function addUser(Request $request)
    {
 
        $users = session()->get('users', []);
        $users[] = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        session()->put('users', $users);

        return redirect()->back()->with('success', 'Сотрудник добавлен');
    }
}
