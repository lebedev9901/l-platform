@extends('layouts.app')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <h1 class="text-4xl font-bold mb-6 text-center">Контакты</h1>
        <p class="text-gray-700 text-lg mb-6 text-center">
            Если у вас есть вопросы или предложения, напишите нам:
        </p>
        <form class="max-w-xl mx-auto flex flex-col gap-4">
            <input type="text" placeholder="Имя" class="border rounded px-4 py-2">
            <input type="email" placeholder="Email" class="border rounded px-4 py-2">
            <textarea placeholder="Сообщение" class="border rounded px-4 py-2"></textarea>
            <button type="submit" class="bg-yellow hover:bg-gold text-darkBlue px-6 py-3 rounded-lg font-semibold">Отправить</button>
        </form>
    </div>
</section>
@endsection
