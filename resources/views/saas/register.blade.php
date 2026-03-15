<!DOCTYPE html>
<html>
<head>
    <title>Регистрация компании</title>
</head>
<body>
    <h1>Создать компанию</h1>
    <form method="POST" action="{{ url('/register-company') }}">
        @csrf
        <div>
            <label>Название компании</label>
            <input type="text" name="company_name" required>
        </div>
        <div>
            <label>Поддомен</label>
            <input type="text" name="subdomain" required>
        </div>
        <div>
            <label>Имя администратора</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Пароль</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Подтвердите пароль</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Создать компанию</button>
    </form>
</body>
</html>