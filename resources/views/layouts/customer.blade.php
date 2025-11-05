<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Customer') - Auto Service Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    </style>
    @stack('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('customer.dashboard') }}" class="text-white text-xl font-bold">
                        👤 Customer Portal
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <span class="text-green-100 text-sm">Welcome, {{ auth()->user()->name }}</span>
                    @else
                        <span class="text-green-100 text-sm">Welcome</span>
                    @endauth

                    @if (Route::has('customer.back'))
                        <form method="GET" action="{{ route('customer.back') }}" class="inline">
                            <button type="submit" class="bg-white/20 text-white px-4 py-2 rounded hover:bg-white/30 transition-colors text-sm">
                                Back
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-white/20 text-white px-4 py-2 rounded hover:bg-white/30 transition-colors text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        @hasSection('header')
            <div class="mb-4">
                @yield('header')
            </div>
        @endif
    </header>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    @stack('scripts')
    @stack('modals')
</body>
</html>
