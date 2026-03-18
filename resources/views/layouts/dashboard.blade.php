<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | l-Platform</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white p-5">

        <h2 class="text-2xl font-bold mb-6">
            Admin panel
        </h2>

        <ul class="space-y-3">

            <li>
                <a href="/dashboard" class="block hover:text-blue-400">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="/employees" class="block hover:text-blue-400">
                    Employees
                </a>
            </li>

            <li>
                <a href="/projects" class="block hover:text-blue-400">
                    Projects
                </a>
            </li>

            <li>
                <a href="/tasks" class="block hover:text-blue-400">
                    Tasks
                </a>
            </li>

            <li>
                <a href="/settings" class="block hover:text-blue-400">
                    Settings
                </a>
            </li>

        </ul>

    </div>


    <!-- Main Content -->
    <div class="flex-1">

        <!-- Topbar -->
        <div class="bg-white shadow p-4 flex justify-between">

            <h1 class="text-xl font-semibold">
                Dashboard
            </h1>

            <div>
                {{ auth()->user()->name }}
            </div>

        </div>


        <!-- Page Content -->
        <div class="p-6">

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>