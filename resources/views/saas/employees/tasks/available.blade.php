@extends('saas.employees.layouts.app')

@section('content')
    <h1>Доступные задачи</h1>
    @forelse($tasks as $task)
        <div>
            <h3>{{ $task->title }}</h3>
            <form action="{{ route('employee.tasks.take', $task) }}" method="POST">
                @csrf
                <button type="submit">Взять в работу</button>
            </form>
        </div>
    @empty
        <p>Нет доступных задач</p>
    @endforelse
@endsection