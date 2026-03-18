<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class EmployeeTaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:employee');
    }
    public function available()
    {
        $employee = auth('employee')->user();
        $tasks = Task::whereDoesntHave('employees')->get();
        return view('saas.employees.tasks.available', compact('tasks'));
    }

    public function take(Task $task)
    {
        $employee = auth('employee')->user();

        if ($task->employees()->exists()){
            return back()->withErrors(['task' => 'Задача назначена другому сотруднику']);
        }

        $task->employees()->attach($employee->id);

        return redirect()->route('employees.dashboard')->with('success', 'Задача в работе');
    }

    public function complete(Task $task)
    {
        $employee = auth('employee')->user();

        $task->employees()->updateExistingPivot($employee->id, ['status' => 'done']);

        return redirect()->back()->with('success', 'Задача выполнена');
    }
}
