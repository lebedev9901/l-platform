@extends('saas.employees.dashboard') {{-- если у тебя есть основной шаблон --}}

@section('content')
@foreach($tasks as $task)
    <div class="task">
        <h5>{{ $task->title }} ({{ $task->company->name }})</h5>
        <p>{{ $task->description }}</p>
        <p>Статус: {{ $task->pivot->status }}</p>

        @if($task->pivot->status === 'new')
            <form action="{{ route('employee.tasks.take', $task) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Взять в работу</button>
            </form>
        @elseif($task->pivot->status === 'in_progress')
            <form action="{{ route('employee.tasks.complete', $task) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Выполнить</button>
            </form>
        @else
            <span class="text-success">Задача выполнена</span>
        @endif
    </div>
@endforeach
@endsection