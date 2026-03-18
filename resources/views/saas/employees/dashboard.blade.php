@extends('saas.employees.layouts.app')

@section('content')
<main class="container mx-auto p-6 space-y-8">

    <!-- ⚡ БЫСТРЫЕ ДЕЙСТВИЯ -->
<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-lg font-bold mb-4">Быстрые действия</h2>

    <div class="flex flex-wrap gap-3">

        <!-- 🔥 ЕСЛИ ЕСТЬ АКТИВНАЯ ЗАДАЧА -->
        {{-- пример состояния --}}
        <a href="#"
           class="px-4 py-2 bg-[#003566] text-white rounded hover:bg-[#001D3D] transition">
            Детали задачи #125
        </a>

        <button
            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
            Завершить задачу #125
        </button>

        <!-- 📥 ВСЕГДА ДОСТУПНО -->
        <a href="{{ route('employees.tasks.available') }}"
           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
            Взять новую задачу
        </a>

    </div>
        <div class="flex flex-wrap gap-3">

        <span class="px-4 py-2 bg-gray-200 text-gray-600 rounded">
            Нет активной задачи
        </span>

        <a href="{{ route('employees.tasks.available') }}"
        class="px-4 py-2 bg-[#003566] text-white rounded hover:bg-[#001D3D] transition">
            Взять задачу
        </a>

        </div>
</div>

    <!-- 🔥 БЛОК СЕГОДНЯ -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-lg font-bold mb-4">Сегодня</h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-4 bg-red-100 rounded-lg">
                <div class="text-2xl font-bold text-red-600">3</div>
                <p class="text-sm text-gray-600">Просрочено</p>
            </div>

            <div class="p-4 bg-yellow-100 rounded-lg">
                <div class="text-2xl font-bold text-yellow-600">5</div>
                <p class="text-sm text-gray-600">На сегодня</p>
            </div>

            <div class="p-4 bg-green-100 rounded-lg">
                <div class="text-2xl font-bold text-green-600">2</div>
                <p class="text-sm text-gray-600">На завтра</p>
            </div>
        </div>
    </div>


    <!-- 📊 KPI -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-sm text-gray-500">Выполнено</h2>
            <div class="text-2xl font-bold text-[#003566]">128</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-sm text-gray-500">Взято в работу</h2>
            <div class="text-2xl font-bold text-[#003566]">150</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-sm text-gray-500">Активные</h2>
            <div class="text-2xl font-bold text-yellow-500">7</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-sm text-gray-500">KPI</h2>
            <div class="text-2xl font-bold text-green-500">85%</div>
        </div>

    </div>


    <!-- 📈 ГРАФИК -->
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


    <!-- 📋 ПОСЛЕДНИЕ ЗАДАЧИ -->
    <div class="bg-white p-6 rounded-xl shadow-md">
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

            <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                <div>
                    <p class="font-semibold">Задача #126</p>
                    <p class="text-sm text-gray-500">Диагностика</p>
                </div>
                <span class="text-red-600 text-sm">Просрочено</span>
            </div>
        </div>
    </div>


    <!-- ⚠ ПРОСРОЧЕННЫЕ -->
    <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-red-500">
        <h2 class="text-lg font-bold mb-4 text-red-600">Просроченные задачи</h2>

        <div class="space-y-3">
            <div class="p-3 bg-red-50 rounded">
                <p class="font-semibold">Задача #120</p>
                <p class="text-sm text-gray-500">Должна была быть выполнена вчера</p>
            </div>

            <div class="p-3 bg-red-50 rounded">
                <p class="font-semibold">Задача #121</p>
                <p class="text-sm text-gray-500">Просрочка 2 дня</p>
            </div>
        </div>
    </div>


    <!-- 🧾 АКТИВНОСТЬ -->
    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-lg font-bold mb-4">Последняя активность</h2>

        <ul class="space-y-2 text-sm text-gray-600">
            <li>✔ Выполнена задача #124</li>
            <li>📥 Взята задача #125</li>
            <li>⚠ Просрочена задача #120</li>
            <li>➕ Назначена новая задача #130</li>
        </ul>
    </div>


    

</main>


<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('tasksChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Пн','Вт','Ср','Чт','Пт','Сб','Вс'],
        datasets: [
            {
                label: 'Выполнено',
                data: [3,5,2,6,4,1,0],
            },
            {
                label: 'Взято в работу',
                data: [4,6,3,7,5,2,1],
            }
        ]
    }
});
</script>

@endsection