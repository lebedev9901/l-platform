<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {

    $company = Company::first();

    $employees = $company->employees()->withCount([
        'tasks',
        'tasks as tasks_in_progress_count' => function($q){
            $q->where('tasks.status', 'В работе');
        },

        'tasks as tasks_done_count' => function ($q){
            $q->where('tasks.status', 'Выполнено');
        },

        'tasks as overdue_tasks_count' => function ($q){
            $q->where('tasks.status', '!=', 'Выполнено')
            ->whereDate('deadline', '<', now());
        }
    ])->get();

    $totalEmployees = $employees->count();
    $totalTasks = Task::where('company_id', $company->id)->count();
    $tasksNew = Task::where('status', 'Новая')->count();
    $tasksInProgress = Task::where('status', 'В работе')->count();
    $tasksDone = Task::where('status', 'Выполнено')->count();
    
    $recentTasks = Task::latest()->take(5)->get();
    
     // Формируем читаемый массив активности
    $recentActivities = $recentTasks->map(function($task) {
        switch($task->status) {
            case 'В работе':
                $emoji = '📥';
                break;
            case 'Выполнено':
                $emoji = '✔';
                break;
            case 'Новая':
                $emoji = '➕';
                break;
            case 'Просрочено':
            default:
                $emoji = '⚠';
        }
        return "$emoji {$task->status} задача #{$task->id} ({$task->title})";
    });
    return view('saas.employees.index', compact(
        'employees',
        'totalEmployees',
        'totalTasks',
        'tasksNew',
        'tasksInProgress',
        'tasksDone',
        'recentActivities'
        
        ));

    }

    public function create()
    {
        return view('saas.employees.create');
    }

    public function store(Request $request)
    {
        $company = Company::first();
       $employee = Employee::create([
            'company_id' => $company->id,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'pin_code' => $request->pin_code
        ]);

        if($request->ajax()){
            return response()->json(['success' => true, 'employee' => $employee]);
        }
        return redirect('/employees');
    }

    public function edit(Employee $employee)
    {
        return view('saas.employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'pin_code' => $request->pin_code
        ]);
    if($request->ajax()){
            return response()->json(['success' => true, 'employee' => $employee]);
        }
        return redirect('/employees');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        if(request()->ajax()){
            return response()->json(['success' => true]);
        }
        return redirect('/employees');

    }

}