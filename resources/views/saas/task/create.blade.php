@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Создать задачу</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название задачи</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Сотрудники</label>
            <select name="employees[]" class="form-select" multiple >
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Создать</button>
    </form>
</div>
@endsection