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
                --accent-success: #10b981;
                --accent-danger: #f43f5e;
                --accent-warning: #ffa62b;
                --accent-cyan: #82c0cc;
            }

            body {
                background: linear-gradient(160deg, #ede7e3 0%, #f5f1ed 100%);
                color: var(--text-primary);
            }

            .app-header {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(12px);
                border-bottom: 1px solid var(--border);
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                color: white;
                transition: transform 140ms ease, box-shadow 140ms ease;
            }

            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 8px 20px -8px rgba(22, 105, 122, 0.4);
            }

            .card {
                background: var(--bg-card);
                border: 1px solid var(--border);
                border-radius: 0.75rem;
                box-shadow: 0 2px 8px -4px rgba(0, 0, 0, 0.08);
            }

            .badge-success {
                background: #d1fae5;
                color: #065f46;
            }

            .badge-danger {
                background: #ffe4e6;
                color: #9f1239;
            }

            .badge-info {
                background: #d8f0f5;
                color: #16697a;
            }

            .badge-warning {
                background: #fef3c7;
                color: #92400e;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="app-header shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
