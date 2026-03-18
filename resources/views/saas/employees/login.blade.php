<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход сотрудника</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #001D3D;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 320px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h1 {
            margin-bottom: 20px;
            color: #003566;
        }

        input {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            text-align: center;
            letter-spacing: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #FFC300;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #FFD60A;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h1>Вход</h1>

    {{-- Ошибка --}}
    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('employee.login') }}">
        @csrf

        <input 
            type="text" 
            name="pin_code" 
            placeholder="Введите PIN" 
            maxlength="6" 
            required 
            autofocus
        >

        <button type="submit">Войти</button>
    </form>
</div>

</body>
</html>