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
                --primary: #6366f1;
                --primary-dark: #4f46e5;
                --primary-light: #a5b4fc;
                --bg-main: #f8f9fb;
                --bg-card: #ffffff;
                --text-primary: #1e293b;
                --text-secondary: #64748b;
                --border: #e2e8f0;
                --accent-success: #10b981;
                --accent-danger: #f43f5e;
                --accent-warning: #f59e0b;
            }

            body {
                background: linear-gradient(160deg, #f8f9fb 0%, #f0f4ff 100%);
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
                box-shadow: 0 8px 20px -8px rgba(99, 102, 241, 0.4);
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
                background: #e0e7ff;
                color: #3730a3;
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
