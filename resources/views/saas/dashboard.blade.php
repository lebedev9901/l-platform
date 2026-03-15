<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Компания: {{ $company->name }}</h1>

    <h2>Сотрудники:</h2>
    <ul>
        @php
            $sessionUsers = session()->get('users', []);
            $allUsers = array_merge($users, $sessionUsers);
        @endphp
        @foreach($allUsers as $user)
            <li>{{ $user->name }} — {{  $user->email }}</li>
        @endforeach
    </ul>

    <h3>Добавить сотрудника</h3>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ url('/dashboard/add-user') }}">
        @csrf
        <input type="text" name="name" placeholder="Имя" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Добавить</button>
    </form>
</body>
</html>