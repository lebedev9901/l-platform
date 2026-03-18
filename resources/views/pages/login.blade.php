@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-md mx-auto px-6 bg-white rounded-xl shadow p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Вход в систему</h1>
        <form action="{{ route('employee.login') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <input type="email" name="email" placeholder="Email" class="border rounded px-4 py-2">
            <input type="password" name="password" placeholder="Пароль" class="border rounded px-4 py-2">
            <button type="submit" class="bg-yellow hover:bg-gold text-darkBlue px-6 py-3 rounded-lg font-semibold">Войти</button>
        </form>
        <p class="mt-4 text-center text-gray-600">
            Нет аккаунта? <a href="{{ route('register.company') }}" class="text-blue-600 hover:underline">Создать компанию</a>
        </p>
    </div>
</section>
@endsection