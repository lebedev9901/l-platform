@extends('layouts.dashboard')

@section('content')
<main class="container mx-auto p-6 space-y-8">

    <!-- ⚡ Быстрые действия -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-lg font-bold mb-4">Быстрые действия</h2>
        <div class="flex flex-wrap gap-3">
            <button class="px-4 py-2 bg-[#003566] text-white rounded hover:bg-[#001D3D]">
                Создать задачу
            </button>
            <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Завершить задачу
            </button>
            <button class="px-4 py-2 bg-yellow-400 rounded hover:bg-yellow-300">
                Просмотр проекта
            </button>
            <button class="px-4 py-2 bg-gray-300 text-gray-500 rounded cursor-not-allowed">
                Нет активной задачи
            </button>
        </div>
    </div>

    <!-- 📊 KPI задач -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-sm text-gray-500">Всего задач</h2>
            <div class="text-2xl font-bold text-[#003566]">150</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-sm text-gray-500">В работе</h2>
            <div class="text-2xl font-bold text-yellow-500">7</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-sm text-gray-500">Выполнено</h2>
            <div class="text-2xl font-bold text-green-500">128</div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-sm text-gray-500">KPI</h2>
            <div class="text-2xl font-bold text-green-600">85%</div>
        </div>
    </div>

    <!-- 📊 KPI проектов -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <div class="bg-blue-500 text-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-sm">Всего проектов</h2>
            <div class="text-2xl font-bold">24</div>
        </div>
        <div class="bg-yellow-400 text-[#001D3D] p-6 rounded-xl shadow-md text-center">
            <h2 class="text-sm">Активные</h2>
            <div class="text-2xl font-bold">8</div>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-sm">Завершено</h2>
            <div class="text-2xl font-bold">12</div>
        </div>
        <div class="bg-red-500 text-white p-6 rounded-xl shadow-md text-center">
            <h2 class="text-sm">Просрочено</h2>
            <div class="text-2xl font-bold">4</div>
        </div>
    </div>

    <!-- 📈 Графики задач и проектов -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">Аналитика задач</h2>
                <div class="flex gap-2">
                    <button class="px-3 py-1 text-sm bg-gray-200 rounded">День</button>
                    <button class="px-3 py-1 text-sm bg-[#003566] text-white rounded">Неделя</button>
                    <button class="px-3 py-1 text-sm bg-gray-200 rounded">Месяц</button>
                </div>
            </div>
            <canvas id="tasksChart"></canvas>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">Аналитика проектов</h2>
            </div>
            <canvas id="projectsChart"></canvas>
        </div>
    </div>

    <!-- 📋 Последние задачи -->
    <div class="bg-white p-6 rounded-xl shadow-md mt-6">
        <h2 class="text-lg font-bold mb-4">Последние задачи</h2>
        <div class="space-y-3">
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                <div>
                    <p class="font-semibold">Задача #124</p>
                    <p class="text-sm text-gray-500">Замена колеса</p>
                </div>
                <span class="text-green-600 text-sm">Выполнено</span>
            </div>
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                <div>
                    <p class="font-semibold">Задача #125</p>
                    <p class="text-sm text-gray-500">Эвакуация авто</p>
                </div>
                <span class="text-yellow-600 text-sm">В работе</span>
            </div>
        </div>
    </div>

    <!-- 📋 Последние проекты -->
    <div class="bg-white p-6 rounded-xl shadow-md mt-6">
        <h2 class="text-lg font-bold mb-4">Последние проекты</h2>
        <div class="space-y-3">
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                <div>
                    <p class="font-semibold">Проект #201</p>
                    <p class="text-sm text-gray-500">Разработка нового сайта</p>
                </div>
                <span class="text-yellow-600 text-sm">В работе</span>
            </div>
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                <div>
                    <p class="font-semibold">Проект #202</p>
                    <p class="text-sm text-gray-500">Обновление CRM</p>
                </div>
                <span class="text-green-600 text-sm">Завершен</span>
            </div>
        </div>
    </div>

</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctxTasks = document.getElementById('tasksChart');
new Chart(ctxTasks, {
    type: 'bar',
    data: {
        labels: ['Пн','Вт','Ср','Чт','Пт','Сб','Вс'],
        datasets: [
            { label: 'Выполнено', data: [3,5,2,6,4,1,0], backgroundColor:'#22c55e' },
            { label: 'В работе', data: [4,6,3,7,5,2,1], backgroundColor:'#facc15' }
        ]
    }
});

const ctxProjects = document.getElementById('projectsChart');
new Chart(ctxProjects, {
    type: 'line',
    data: {
        labels: ['Неделя 1','Неделя 2','Неделя 3','Неделя 4'],
        datasets: [
            { label: 'Создано', data: [2,4,3,5], borderColor:'#003566', tension:0.3 },
            { label: 'Завершено', data: [1,2,3,4], borderColor:'#16a34a', tension:0.3 }
        ]
    }
});
</script>
@endsection