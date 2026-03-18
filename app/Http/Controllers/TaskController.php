<?php

namespace App\Http\Controllers;

use App\Events\TaskUpdated;
use App\Models\Task;
use App\Notifications\TaskUpdateNotification;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create()
    {
        $company = auth()->user()->company;

        $employees = $company->employees;

        return view('saas.task.create', compact('employees'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'employees' => 'required|array'
    ]);

    $company = auth()->user()->company;

    $task = Task::create([
        'company_id' => $company->id,
        'title' => $request->title,
        'description' => $request->description,
        'status' => 'new',
        'deadline' => $request->deadline
    ]);

    // привязываем сотрудников
    $task->employees()->attach($request->employees);

    foreach($task->employees as $employee){
        $employee->notify(new TaskUpdateNotification($task, $employee->id));
    }

    return redirect()->back()->with('success', 'Задача создана');
    }

    public function index()
{
    $company = auth()->user()->company;

    $tasks = $company->tasks()->with('employees')->get();

    return view('saas.task.index', compact('tasks'));
}


}
