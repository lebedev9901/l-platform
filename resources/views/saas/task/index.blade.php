@extends('layouts.dashboard')

@section('content')
<h1>Задачи</h1>
<a href="{{ route('task.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded"> AddTask</a>

@foreach($tasks as $task)
    <div style="border:1px solid #ccc; margin-bottom:10px; padding:10px;">
        <strong>{{ $task->title }}</strong>

        <br>Сотрудники:
        <ul>
            @foreach($task->employees as $emp)
                <li>{{ $emp->name }}</li>
            @endforeach
        </ul>

        <br>Статус: {{ $task->status }}
    </div>
@endforeach
@endsection