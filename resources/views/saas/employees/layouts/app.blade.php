<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Дашборд сотрудника</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

<!-- Шапка -->
<header class="bg-[#003566] text-white">
    <div class="container mx-auto flex flex-wrap items-center justify-between p-4">
        <h1 class="text-mb ">Добро пожаловать, {{ auth()->user()->name }}</h1>
        <nav class="flex flex-wrap gap-3 items-center mt-2 sm:mt-0">
            <a href="#" class="px-4 py-2 rounded hover:bg-[#001D3D] ">Главная</a>
            <a href="{{ route('employees.tasks.available') }}" class="px-4 py-2 rounded hover:bg-[#001D3D] font-semibold">Задачи</a>
            
                <a href="#" class="px-4 py-2 rounded hover:bg-[#001D3D] ">Склад / ТМЦ</a>
                <a href="#" class="px-4 py-2 rounded hover:bg-[#001D3D] ">Уведомления</a>
                <a href="#" class="px-4 py-2 rounded hover:bg-[#001D3D] ">Чаты</a>
         
            <a href="#" class="px-4 py-2 rounded hover:bg-[#001D3D]">Профиль</a>
            <form method="POST" action="{{ route('employee.logout') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-yellow-400 hover:bg-yellow-300 rounded">Выход</button>
            </form>
        </nav>
    </div>
</header>

@yield('content')

</body>
</html>