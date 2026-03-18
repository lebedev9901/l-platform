<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'L-Platform' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                darkBlue: '#001D3D',
                deepBlue: '#003566',
                yellow: '#FFC300',
                gold: '#FFD60A',
              }
            }
          }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans text-gray-900">

    <!-- HEADER -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="font-bold text-xl text-deepBlue">L-Platform</a>
            <ul class="flex gap-6 text-gray-700">
                <li><a href="/about" class="hover:text-black">О платформе</a></li>
                <li><a href="/features" class="hover:text-black">Возможности</a></li>
                <li><a href="/contacts" class="hover:text-black">Контакты</a></li>
                <li><a href="/privacy" class="hover:text-black">Политика</a></li>
                <li>
                    <a href="/create" class="bg-yellow hover:bg-gold text-darkBlue px-4 py-2 rounded-lg font-medium">Создать</a>
                </li>
            </ul>
        </div>
    </header>

    <!-- MAIN -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <ul class="flex gap-6 text-gray-600">
                <li><a href="/contacts" class="hover:text-black">Контакты</a></li>
                <li><a href="/privacy" class="hover:text-black">Политика</a></li>
                <li><a href="#" class="hover:text-black">Поддержка</a></li>
            </ul>
            <span class="text-gray-500">&copy; {{ date('Y') }} L-Platform</span>
        </div>
    </footer>

</body>
</html>