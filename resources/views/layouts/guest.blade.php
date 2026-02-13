<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --primary: #16697a;
                --primary-dark: #124f5d;
                --primary-light: #489fb5;
                --bg-main: #ede7e3;
                --bg-card: #ffffff;
                --text-primary: #2c3e50;
                --text-secondary: #5a6c7d;
                --border: #d4cdc5;
                --accent-cyan: #82c0cc;
                --accent-orange: #ffa62b;
            }

            body {
                background: linear-gradient(160deg, #ede7e3 0%, #f5f1ed 100%);
                color: var(--text-primary);
            }

            .auth-logo {
                width: 4rem;
                height: 4rem;
                border-radius: 1rem;
                display: grid;
                place-items: center;
                background: linear-gradient(145deg, var(--primary), var(--primary-light));
                color: #fff;
                box-shadow: 0 12px 35px -10px rgba(22, 105, 122, 0.2);
                font-size: 2rem;
                line-height: 1;
                transition: transform 140ms ease;
            }

            .auth-logo:hover {
                transform: translateY(-2px);
            }

            .auth-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(12px);
                border: 1px solid var(--border);
                box-shadow: 0 8px 32px -8px rgba(22, 105, 122, 0.15);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <div class="auth-logo">♪</div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 auth-card overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
