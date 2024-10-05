@props([
    'title'
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css\app.css', 'resources/js/app.js'])
</head>
<body class="app-grid">
    <header>
        <div class="container py-3 mb-4 border-bottom">
            <h1 class="h3 mb-4">{{ $title }}</h1>
        </div>
    </header>
    <div>
        <div class="container">
            <div class="row">
                <div class="col col-12 col-md-3">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{ route('index') }}" class="nav-link link-dark">Главная</a>
                        </li>
                        @if ($city)
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link link-dark">О нас</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('news') }}" class="nav-link link-dark">Новости</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <main class="col col-12 col-md-9">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    <footer class="py-3 m4-3 border-top">
        <div class="container">
            footer
        </div>
    </footer>
</body>
</html>