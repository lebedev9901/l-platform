@extends('layouts.dashboard')

@section('content')
<main class="container mx-auto p-6 space-y-6">

    <!-- 🔝 KPI -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-[#003566] text-white p-6 rounded-xl shadow-md">
            <h2 class="text-sm text-gray-200">Сотрудники</h2>
            <div id="kpiEmployees" class="text-2xl font-bold">{{$totalEmployees}}</div>
        </div>

        <div class="bg-[#FFC300] text-[#001D3D] p-6 rounded-xl shadow-md">
            <h2 class="text-sm text-gray-700">Всего задач</h2>
            <div id="kpiTasksTotal" class="text-2xl font-bold">{{ $totalTasks }}</div>
        </div>

        <div class="bg-green-500 text-white p-6 rounded-xl shadow-md">
            <h2 class="text-sm text-gray-200">В работе</h2>
            <div id="kpiTasksInProgress" class="text-2xl font-bold">{{ $tasksInProgress }}</div>
        </div>

        <div class="bg-gray-500 text-white p-6 rounded-xl shadow-md">
            <h2 class="text-sm text-gray-200">Выполнено</h2>
            <div id="kpiTasksDone" class="text-2xl font-bold">{{ $tasksDone }}</div>
        </div>
    </div>

    <!-- 🕒 Последняя активность -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-lg font-bold mb-4">Последняя активность</h2>
        <ul id="recentActivities" class="space-y-2 text-sm text-gray-600">
            @foreach ($recentActivities as $activity)
            <li>{{ $activity }}</li>
            @endforeach
            
        </ul>
    </div>

    <!-- Заголовок и кнопка -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">Сотрудники</h2>
        <button onclick="openModal('createEmployeeModal')" 
            class="bg-[#003566] text-white px-4 py-2 rounded hover:bg-[#001D3D]">
            + Добавить сотрудника
        </button>
    </div>

    <!-- Поиск -->
    <div class="bg-white p-4 rounded-xl shadow-md">
        <input type="text" placeholder="Поиск сотрудника..."
               class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#003566]" id="searchEmployee">
    </div>

    <!-- Список сотрудников -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="employeeList">
        @foreach($employees as $employee)
            <div class="bg-white p-5 rounded-xl shadow-md hover:shadow-lg transition" data-name="{{ $employee->name }}"
            data-name="{{ $employee->name }}"
            data-employee-id="{{ $employee->id }}">
                <h3 class="text-lg font-bold text-[#003566]">{{ $employee->name }}</h3>
                <p class="text-sm text-gray-500">{{ $employee->email }}</p>
                <p class="text-sm mt-2"><span class="font-semibold">Роль:</span> {{ $employee->role }}</p>
                <p class="text-sm"><span class="font-semibold">PIN:</span> {{ $employee->pin_code }}</p>

                <!-- Статистика задач -->
                <div class="mt-3 text-sm space-y-1">
                    <p>Всего задач: <span class="font-semibold">{{ $employee->tasks_count }}</span></p>
                    <p>В работе: <span class="font-semibold text-yellow-600">{{ $employee->tasks_in_progress_count }}</span></p>
                    <p>Выполнено: <span class="font-semibold text-green-600">{{ $employee->tasks_done_count }}</span></p>
                    <p>Просрочено: <span class="font-semibold text-red-600">{{ $employee->overdue_tasks_count }}</span></p>
                </div>

                <!-- Действия -->
                <div class="flex gap-3 mt-4">
                    <button onclick="openEditModal({{ $employee->id }})"
                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Изменить
                    </button>
                    <button onclick="deleteEmployee({{ $employee->id }})"
                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                        Удалить
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</main>

<!-- Модалки -->
<div id="createEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-lg relative">
        <h2 class="text-xl font-bold mb-4">Создать сотрудника</h2>
        <div id="createEmployeeContent">
            <p class="text-gray-500">Загрузка формы...</p>
        </div>
        <button onclick="closeModal('createEmployeeModal')" class="absolute top-3 right-3 text-gray-500 hover:text-black">✕</button>
    </div>
</div>

<div id="editEmployeeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-lg relative">
        <h2 class="text-xl font-bold mb-4">Редактировать сотрудника</h2>
        <div id="editEmployeeContent">
            <p class="text-gray-500">Загрузка формы...</p>
        </div>
        <button onclick="closeModal('editEmployeeModal')" class="absolute top-3 right-3 text-gray-500 hover:text-black">✕</button>
    </div>
</div>

<!-- JS -->
<script>
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.getElementById(id).classList.add('flex');

    if(id === 'createEmployeeModal') {
        fetch('/employees/create')
            .then(res => res.text())
            .then(html => document.getElementById('createEmployeeContent').innerHTML = html);
    }
}

function openEditModal(id) {
    document.getElementById('editEmployeeModal').classList.remove('hidden');
    document.getElementById('editEmployeeModal').classList.add('flex');

    fetch(`/employees/${id}/edit`)
        .then(res => res.text())
        .then(html => document.getElementById('editEmployeeContent').innerHTML = html);
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.getElementById(id).classList.remove('flex');
}

function deleteEmployee(id) {
    if(!confirm('Удалить сотрудника?')) return;

    fetch(`/employees/${id}`, {
        method: 'DELETE',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    }).then(() => location.reload());
}

// 🔍 Поиск
document.getElementById('searchEmployee').addEventListener('input', function() {
    const filter = this.value.toLowerCase();
    document.querySelectorAll('#employeeList > div').forEach(el => {
        el.style.display = el.dataset.name.toLowerCase().includes(filter) ? '' : 'none';
    });
});
</script>
<script>
const kpiEmployees = document.getElementById('kpiEmployees');
const kpiTasksTotal = document.getElementById('kpiTasksTotal');
const kpiTasksInProgress = document.getElementById('kpiTasksInProgress');
const kpiTasksDone = document.getElementById('kpiTasksDone');
const activityList = document.getElementById('recentActivities');

function dashBoard(){

// Убираем Echo, делаем просто AJAX polling каждые 5 секунд
    // 1️⃣ Последняя активность
    fetch('/api/employees/notifications')
        .then(res => res.json())
        .then(data => {
            activityList.innerHTML = '';
            data.forEach(act => {
                const li = document.createElement('li');
                li.textContent = `📌 Задача "${act.title}" обновлена, статус: ${act.status}`;
                activityList.prepend(li);
            });
        });

    // 2️⃣ KPI
    fetch('/api/employees/kpi')
        .then(res => res.json())
        .then(data => {
            kpiEmployees.textContent = data.totalEmployees;
            kpiTasksTotal.textContent = data.totalTasks;
            kpiTasksInProgress.textContent = data.tasksInProgress;
            kpiTasksDone.textContent = data.tasksDone;
        });
}
setInterval(dashBoard, 5000);
dashBoard();
</script>
@endsection