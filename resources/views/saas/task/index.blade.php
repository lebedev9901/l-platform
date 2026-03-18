@extends('layouts.dashboard')

@section('content')

<h1 class="text-2xl font-bold mb-2">Задачи</h1>

<!-- KPI -->
<div class="grid grid-cols-5 gap-4 mb-6">
    <div class="bg-white p-4 rounded-xl shadow">Всего: {{ $kpi['total'] }}</div>
    <div class="bg-blue-100 p-4 rounded-xl shadow">Новые: {{ $kpi['new'] }}</div>
    <div class="bg-yellow-100 p-4 rounded-xl shadow">В работе: {{ $kpi['in_progress'] }}</div>
    <div class="bg-green-100 p-4 rounded-xl shadow">Готово: {{ $kpi['done'] }}</div>
    <div class="bg-purple-100 p-4 rounded-xl shadow">Выполнено в этом месяце: {{ $percentDone }}%</div>
</div>

<!-- Кнопка -->
<button onclick="openModal()"
    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl mb-4">
    ➕ Добавить задачу
</button>

<!-- Список задач -->
<div class="grid grid-cols-3 gap-4">
@foreach($tasks as $task)
    <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition">

        <div class="flex justify-between items-center">
            <strong>{{ $task->title }}</strong>

            <span class="text-xs px-2 py-1 rounded-full
                @if($task->status == 'new') bg-blue-200
                @elseif($task->status == 'in_progress') bg-yellow-200
                @else bg-green-200
                @endif
            ">
                {{ $task->status }}
            </span>
        </div>

        <div class="mt-3 flex flex-wrap gap-1">
            @forelse($task->employees as $emp)
                <span class="bg-gray-200 px-2 py-1 rounded text-xs">{{ $emp->name }}</span>
            @empty
                <span class="text-gray-400 text-xs">Нет исполнителей</span>
            @endforelse
        </div>

        <button onclick="editTask({{ $task->id }})"
            class="mt-3 text-blue-500 text-sm hover:underline">
            ✏️ Редактировать
        </button>

    </div>
@endforeach
</div>

<!-- MODAL -->
<div id="taskModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-xl">

        <h2 class="text-lg font-semibold mb-4" id="modalTitle">Новая задача</h2>

        <form method="POST" id="taskForm" action="{{ route('tasks.store') }}">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <input type="text" name="title" id="title" placeholder="Название"
                class="w-full border p-2 rounded mb-3" required>

            <textarea name="description" id="description" placeholder="Описание"
                class="w-full border p-2 rounded mb-3"></textarea>

            <label class="block mb-2 text-sm font-medium">Сотрудники (необязательно)</label>
            <div class="max-h-40 overflow-y-auto border rounded p-2 mb-4">
                @foreach($employees as $employee)
                    <label class="flex items-center gap-2 mb-1">
                        <input type="checkbox" name="employees[]" value="{{ $employee->id }}">
                        {{ $employee->name }}
                    </label>
                @endforeach
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-300 rounded-lg">Отмена</button>
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Создать
                </button>
            </div>
        </form>

    </div>
</div>

<script>
function openModal() {
    document.getElementById('taskModal').classList.remove('hidden');
    document.getElementById('modalTitle').innerText = "Новая задача";
    document.getElementById('taskForm').reset();
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('taskForm').action = "{{ route('tasks.store') }}";
}

function closeModal() {
    document.getElementById('taskModal').classList.add('hidden');
}

// EDIT TASK
function editTask(id) {
    fetch(`/tasks/${id}`)
    .then(res => res.json())
    .then(task => {
        if(task.error){
            alert(task.error);
            return;
        }

        openModal();

        document.querySelector('input[name="title"]').value = task.title;
        document.querySelector('textarea[name="description"]').value = task.description ?? '';
        document.querySelectorAll('input[name="employees[]"]').forEach(cb=>{
            cb.checked = task.employees.some(e=>e.id == cb.value);
        });

        document.getElementById('taskForm').action = `/tasks/${id}`;
        document.getElementById('formMethod').value = 'PUT';
    });
}
</script>

@endsection