@props(['containerClass' => 'w-full max-w-md'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sign in to Your Account') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'])
        
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes slideUp {
                from { transform: translateY(20px); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            .input-focus:focus {
                transform: translateY(-1px);
                box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
            }
            .animate-fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }
            .animate-slide-up {
                animation: slideUp 0.4s ease-out;
            }
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen gradient-bg p-0 animate-fade-in">
            <!-- Navigation to match welcome styling -->
            <nav class="bg-white/10 backdrop-blur-md border-b border-white/20 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <a href="/" class="text-white text-xl font-bold">🚗 Auto Service Platform</a>
                        </div>
                        <div class="flex items-center space-x-4">
                            <a href="/login/customer" class="text-white hover:text-green-200 transition-colors text-sm">Customer</a>
                            <a href="/login/service-station" class="text-white hover:text-orange-200 transition-colors text-sm">Service Station</a>
                            <a href="/login/vendor" class="text-white hover:text-purple-200 transition-colors text-sm">Vendor</a>
                            <a href="/login/admin" class="text-white hover:text-red-200 transition-colors text-sm font-semibold bg-white/20 px-3 py-1 rounded">Admin</a>
                        </div>
                    </div>
                </div>
            </nav>
            
            <div class="flex items-center justify-center p-4">
            <!-- Background Decoration -->
            <div class="fixed inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-4 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
                <div class="absolute -top-4 -right-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
            </div>

            <div class="{{ $containerClass }} relative">
                <!-- Logo/Brand Section -->
                <div class="text-center mb-8 animate-slide-up">
                    <!-- <a href="/">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4 shadow-lg hover:shadow-xl transition-shadow duration-200">
                            <x-application-logo class="w-8 h-8 text-white" />
                        </div>
                    </a> -->
                    <h1 class="text-3xl font-bold text-white drop-shadow mb-2">Welcome Back</h1>
                    <p class="text-white drop-shadow">Sign in to your account</p>
                </div>

                <!-- Main Content Card -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-white/20 animate-slide-up w-full max-w-2xl" style="animation-delay: 0.1s;">
                    {{ $slot }}
                </div>
            </div>
            </div>
        <!-- Add some interactive JavaScript -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add focus effects to form elements
                const inputs = document.querySelectorAll('input');
                inputs.forEach(input => {
                    input.addEventListener('focus', function() {
                        if (this.parentElement.classList.contains('relative')) {
                            this.parentElement.classList.add('transform', 'scale-105', 'transition-transform', 'duration-200');
                        }
                    });
                    input.addEventListener('blur', function() {
                        if (this.parentElement.classList.contains('relative')) {
                            this.parentElement.classList.remove('transform', 'scale-105', 'transition-transform', 'duration-200');
                        }
                    });
                });
            });
        </script>
    </body>
</html>
