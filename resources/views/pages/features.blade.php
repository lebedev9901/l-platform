@extends('layouts.app')

@section('content')
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8 text-center">
        <h1 class="text-4xl font-bold col-span-3 mb-10">Возможности L-Platform</h1>
        <article class="p-6 border rounded-xl hover:shadow-lg transition">
            <span class="text-4xl mb-2 block">⚙️</span>
            <h3 class="font-semibold mb-2">Автоматизация процессов</h3>
            <p class="text-gray-600">Настройка шаблонов задач, автоматическое распределение и контроль.</p>
        </article>
        <article class="p-6 border rounded-xl hover:shadow-lg transition">
            <span class="text-4xl mb-2 block">👥</span>
            <h3 class="font-semibold mb-2">Управление сотрудниками</h3>
            <p class="text-gray-600">Назначение ролей, контроль времени и отчетность для каждого сотрудника.</p>
        </article>
        <article class="p-6 border rounded-xl hover:shadow-lg transition">
            <span class="text-4xl mb-2 block">📊</span>
            <h3 class="font-semibold mb-2">Аналитика и отчёты</h3>
            <p class="text-gray-600">Графики, KPI и отчёты по задачам и работе сотрудников в реальном времени.</p>
        </article>
    </div>
</section>
@endsection
