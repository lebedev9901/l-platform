@extends('layouts.app')

@section('content')
<!-- HERO -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Управляйте бизнесом в одной системе</h1>
            <p class="text-gray-600 mb-6 text-lg">Автоматизация, контроль, аналитика, задачи</p>
            <div class="flex gap-4 flex-wrap">
                <a href="/login" class="bg-yellow hover:bg-gold text-darkBlue px-6 py-3 rounded-lg font-semibold">Войти</a>
                <a href="/create" class="border border-gray-300 px-6 py-3 rounded-lg hover:bg-gray-100">Создать</a>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-center">
            <div class="h-48 w-full bg-gray-100 rounded animate-pulse"></div>
        </div>
    </div>
</section>

<!-- Возможности -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-6 text-center">
        <article class="p-6 border rounded-xl hover:shadow-lg transition">
            <span class="block mb-2 text-4xl">⚙️</span>
            <h3 class="font-semibold mb-2">Автоматизация процессов</h3>
        </article>
        <article class="p-6 border rounded-xl hover:shadow-lg transition">
            <span class="block mb-2 text-4xl">👥</span>
            <h3 class="font-semibold mb-2">Управление сотрудниками</h3>
        </article>
        <article class="p-6 border rounded-xl hover:shadow-lg transition">
            <span class="block mb-2 text-4xl">📊</span>
            <h3 class="font-semibold mb-2">Аналитика и отчёты</h3>
        </article>
        <article class="p-6 border rounded-xl hover:shadow-lg transition">
            <span class="block mb-2 text-4xl">📦</span>
            <h3 class="font-semibold mb-2">Склад и ресурсы</h3>
        </article>
    </div>
</section>

<!-- Пошаговое начало -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 grid gap-6 text-center">
        <p class="text-lg font-semibold">1. Создайте компанию</p>
        <p class="text-lg font-semibold">2. Добавьте сотрудников</p>
        <p class="text-lg font-semibold">3. Настройте процессы</p>
        <p class="text-lg font-semibold">4. Начните работу</p>
    </div>
</section>
@endsection