<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Registration - Auto Service Platform</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div>
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-white mb-2">🚗 Auto Service Platform</h1>
                    <h2 class="text-2xl font-extrabold text-white">
                        Customer Registration
                    </h2>
                    <p class="mt-2 text-center text-sm text-blue-100">
                        Create your account to book services and manage your vehicles
                    </p>
                </div>
            </div>
            
            <!-- Registration Form -->
            <div class="bg-white/10 backdrop-blur-md rounded-lg shadow-xl border border-white/20 p-8">
                @if ($errors->any())
                    <div class="mb-4 bg-red-500/20 border border-red-500/50 text-red-100 px-4 py-3 rounded">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 bg-green-500/20 border border-green-500/50 text-green-100 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form class="space-y-6" action="{{ route('register.customer') }}" method="POST">
                    @csrf
                    
                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-white">
                            Full Name
                        </label>
                        <div class="mt-1">
                            <input id="name" 
                                   name="name" 
                                   type="text" 
                                   required 
                                   value="{{ old('name') }}"
                                   class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm bg-white/90" 
                                   placeholder="Enter your full name">
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white">
                            Email Address
                        </label>
                        <div class="mt-1">
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   autocomplete="email" 
                                   required 
                                   value="{{ old('email') }}"
                                   class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm bg-white/90" 
                                   placeholder="Enter your email address">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-white">
                            Phone Number
                        </label>
                        <div class="mt-1">
                            <input id="phone" 
                                   name="phone" 
                                   type="tel" 
                                   required 
                                   value="{{ old('phone') }}"
                                   class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm bg-white/90" 
                                   placeholder="+94 77 123 4567">
                        </div>
                        @error('phone')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white">
                            Password
                        </label>
                        <div class="mt-1">
                            <input id="password" 
                                   name="password" 
                                   type="password" 
                                   autocomplete="new-password" 
                                   required 
                                   class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm bg-white/90" 
                                   placeholder="Create a password">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-white">
                            Confirm Password
                        </label>
                        <div class="mt-1">
                            <input id="password_confirmation" 
                                   name="password_confirmation" 
                                   type="password" 
                                   autocomplete="new-password" 
                                   required 
                                   class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm bg-white/90" 
                                   placeholder="Confirm your password">
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Register Button -->
                    <div>
                        <button type="submit" 
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-green-500 group-hover:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                </svg>
                            </span>
                            Create Customer Account
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-sm text-blue-100">
                            Already have an account? 
                            <a href="/login/customer" class="font-medium text-green-300 hover:text-green-200 underline">
                                Sign in here
                            </a>
                        </p>
                    </div>

                    <!-- Back to Home -->
                    <div class="text-center">
                        <a href="/" class="text-sm text-gray-300 hover:text-white">
                            ← Back to home
                        </a>
                    </div>
                </form>
            </div>

            <!-- User Type Switcher -->
            <div class="text-center">
                <p class="text-sm text-blue-100 mb-3">Register as different user type:</p>
                <div class="flex justify-center space-x-2 flex-wrap">
                    <a href="/customer/register" 
                       class="px-3 py-1 text-xs rounded bg-green-500 text-white transition-colors">
                        Customer
                    </a>
                    <a href="/service-station/register" 
                       class="px-3 py-1 text-xs rounded bg-white/20 text-blue-100 hover:bg-white/30 transition-colors">
                        Service Station
                    </a>
                    <a href="/vendor/register" 
                       class="px-3 py-1 text-xs rounded bg-white/20 text-blue-100 hover:bg-white/30 transition-colors">
                        Vendor
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>