<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $company = auth()->user()->company; // текущая компания сотрудника
        $tasks = $company->tasks()->with('employees')->latest()->get();

        $kpi = [
            'total' => $tasks->count(),
            'new' => $tasks->where('status','new')->count(),
            'in_progress' => $tasks->where('status','in_progress')->count(),
            'done' => $tasks->where('status','done')->count(),
        ];

        $currentMonthTasks = $tasks->filter(fn($t)=> $t->created_at->isCurrentMonth());
        $percentDone = $currentMonthTasks->count()
            ? round($currentMonthTasks->where('status','done')->count() / $currentMonthTasks->count() * 100,1)
            : 0;

        $employees = $company->employees;

        return view('saas.task.index', compact('tasks','kpi','percentDone','employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'employees'=>'nullable|array'
        ]);

        $company = auth()->user()->company;

        $task = Task::create([
            'company_id'=>$company->id,
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>'new',
            'deadline'=>$request->deadline ?? null,
        ]);

        if($request->employees){
            $task->employees()->attach($request->employees);
        }

        return redirect()->back()->with('success','Задача создана');
    }

    public function show($id)
{
    $company = app('currentCompany'); // как в EmployeeController

    $task = $company->tasks()->with('employees')->find($id);

    if (!$task) {
        return response()->json(['error' => 'Задача не найдена'], 404);
    }

    return response()->json([
        'id' => $task->id,
        'title' => $task->title,
        'description' => $task->description,
        'status' => $task->status,
        'deadline' => $task->deadline,
        'employees' => $task->employees->map(fn($e)=>['id'=>$e->id,'name'=>$e->name]),
    ]);
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'employees'=>'nullable|array'
        ]);

        $company = auth()->user()->company;
        $task = $company->tasks()->findOrFail($id);

        $task->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status ?? $task->status,
            'deadline'=>$request->deadline ?? $task->deadline,
        ]);

        $task->employees()->sync($request->employees ?? []);

        return redirect()->back()->with('success','Задача обновлена');
    }
}