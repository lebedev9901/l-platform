<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeNotificationController extends Controller
{
    public function index()
    {
        $employee = auth()->user();
        $notifications = $employee->notifications()->latest()->take(10)->get();

        return response()->json($notifications->map(fn($n) => $n->data));
    }

    public function kpi()
    {
        $company = auth()->user()->company;
        $employees = $company->employees()->withCount([
            'tasks',
            'tasks as tasks_in_progress_count' => fn($q) => $q->where('status', 'in_progress'),
            'tasks as tasks_done_count' => fn($q) => $q->where('status', 'done')
        ])->get();

        $totalTasks = $employees->sum('tasks_count');
        $tasksInProgress = $employees->sum('tasks_in_progress_count');
        $tasksDone = $employees->sum('tasks_done_count');

        return response()->json([
            'totalEmployees' => $employees->count(),
            'totalTasks' => $totalTasks,
            'tasksInProgress' => $tasksInProgress,
            'tasksDone' => $tasksDone
        ]);

    }
}
