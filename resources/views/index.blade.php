<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сократитель ссылок</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100dvh;
            background-color: #f0f2f5;
            margin: 0px;
            box-sizing: border-box;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
        }

        input[type="url"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .success {
            margin-top: 15px;
            background: #e0ffe0;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Сократитель ссылок</h1>

        <form action="{{ route('links.store') }}" method="POST">
            @csrf
            <input type="url" name="original_url" placeholder="Введите ваш URL сюда" required>
            <br>
            <button type="submit">Сократить</button>
        </form>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first('original_url') }}
            </div>
        @endif

        @if (session('shortened_link'))
            <div class="success">
                Ваша короткая ссылка:
                <a href="{{ session('shortened_link') }}" target="_blank">
                    {{ session('shortened_link') }}
                </a>
            </div>
        @endif
    </div>
</body>

</html>
