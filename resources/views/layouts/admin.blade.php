<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Admin Dashboard') - Auto Service Platform</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        [x-cloak] { display: none !important; }
        
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Top Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-white text-xl font-bold">
                        ⚡ Admin Dashboard
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-red-100 text-sm">Welcome, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-white/20 text-white px-4 py-2 rounded hover:bg-white/30 transition-colors text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-100 border-t mt-8">
        <div class="max-w-7xl mx-auto py-4 px-4 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Auto Service Platform. All rights reserved.
        </div>
    </footer>
</body>
</html>
