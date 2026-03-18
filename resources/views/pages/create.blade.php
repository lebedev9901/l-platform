@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-xl mx-auto px-6 bg-white rounded-xl shadow p-8">
        <h1 class="text-3xl font-bold mb-6 text-center">Создать компанию</h1>
        <form method="POST" action="{{ url('/register-company') }}" class="flex flex-col gap-4">
            @csrf
            <input type="text" name="company_name" placeholder="Название компании" class="border rounded px-4 py-2" required>
            <input type="text" name="subdomain" placeholder="Название компании" class="border rounded px-4 py-2" required>
            <input type="email" name="email" placeholder="Email администратора" class="border rounded px-4 py-2" required>
            <input type="name" name="name" placeholder="администратора" class="border rounded px-4 py-2" required>
            <input type="password" name="password" placeholder="Пароль" class="border rounded px-4 py-2" required>
            <input type="password" name="password_confirmation" class="border rounded px-4 py-2" required>
            <button type="submit" class="bg-yellow hover:bg-gold text-darkBlue px-6 py-3 rounded-lg font-semibold">Создать компанию</button>
        </form>
    </div>
</section>
@endsection