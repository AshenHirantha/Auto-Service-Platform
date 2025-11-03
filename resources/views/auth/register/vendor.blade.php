<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parts Vendor Registration - Auto Service Platform</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl w-full space-y-8">
            <!-- Header -->
            <div>
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-white mb-2">🛠️ Auto Service Platform</h1>
                    <h2 class="text-2xl font-extrabold text-white">
                        Parts Vendor Registration
                    </h2>
                    <p class="mt-2 text-center text-sm text-purple-100">
                        Register your business to sell auto parts and accessories
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
                
                <form class="space-y-6" action="{{ route('register.vendor') }}" method="POST">
                    @csrf
                    
                    <!-- Account Information Section -->
                    <div class="border-b border-white/20 pb-6">
                        <h3 class="text-lg font-medium text-white mb-4">Account Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Contact Person Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-white">
                                    Contact Person Name
                                </label>
                                <div class="mt-1">
                                    <input id="name" 
                                           name="name" 
                                           type="text" 
                                           required 
                                           value="{{ old('name') }}"
                                           class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
                                           placeholder="Enter contact person name">
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Business Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-white">
                                    Business Email
                                </label>
                                <div class="mt-1">
                                    <input id="email" 
                                           name="email" 
                                           type="email" 
                                           autocomplete="email" 
                                           required 
                                           value="{{ old('email') }}"
                                           class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
                                           placeholder="Enter business email">
                                </div>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Business Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-white">
                                    Business Phone
                                </label>
                                <div class="mt-1">
                                    <input id="phone" 
                                           name="phone" 
                                           type="tel" 
                                           required 
                                           value="{{ old('phone') }}"
                                           class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
                                           placeholder="+94 11 123 4567">
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
                                           class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
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
                                           class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
                                           placeholder="Confirm password">
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Business Information Section -->
                    <div>
                        <h3 class="text-lg font-medium text-white mb-4">Business Information</h3>
                        <div class="space-y-4">
                            <!-- Business Name -->
                            <div>
                                <label for="vendor_name" class="block text-sm font-medium text-white">
                                    Business Name
                                </label>
                                <div class="mt-1">
                                    <input id="vendor_name" 
                                           name="vendor_name" 
                                           type="text" 
                                           required 
                                           value="{{ old('vendor_name') }}"
                                           class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
                                           placeholder="Enter business name">
                                </div>
                                @error('vendor_name')
                                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Business Address -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-white">
                                    Business Address
                                </label>
                                <div class="mt-1">
                                    <textarea id="location" 
                                              name="location" 
                                              rows="3" 
                                              required
                                              class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
                                              placeholder="Enter complete business address">{{ old('location') }}</textarea>
                                </div>
                                @error('location')
                                    <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Business Hours -->
                                <div>
                                    <label for="business_hours" class="block text-sm font-medium text-white">
                                        Business Hours
                                    </label>
                                    <div class="mt-1">
                                        <input id="business_hours" 
                                               name="business_hours" 
                                               type="text" 
                                               required 
                                               value="{{ old('business_hours') }}"
                                               class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
                                               placeholder="Mon-Sat: 9:00 AM - 5:00 PM">
                                    </div>
                                    @error('business_hours')
                                        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Business Registration Number -->
                                <div>
                                    <label for="tax_info" class="block text-sm font-medium text-white">
                                        Business Registration Number
                                    </label>
                                    <div class="mt-1">
                                        <input id="tax_info" 
                                               name="tax_info" 
                                               type="text" 
                                               required 
                                               value="{{ old('tax_info') }}"
                                               class="appearance-none relative block w-full px-3 py-2 border border-white/30 placeholder-gray-400 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm bg-white/90" 
                                               placeholder="Enter business registration number">
                                    </div>
                                    @error('tax_info')
                                        <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features Preview -->
                    <div class="bg-purple-500/20 border border-purple-500/50 text-purple-100 px-4 py-3 rounded">
                        <h4 class="font-medium mb-2">What you'll get:</h4>
                        <ul class="text-sm space-y-1">
                            <li>• Manage your parts catalog and inventory</li>
                            <li>• Receive and fulfill orders from customers</li>
                            <li>• Set competitive pricing and track sales</li>
                            <li>• Connect with service stations for bulk orders</li>
                        </ul>
                    </div>

                    <!-- Approval Notice -->
                    <div class="bg-yellow-500/20 border border-yellow-500/50 text-yellow-100 px-4 py-3 rounded">
                        <p class="text-sm">
                            <strong>Note:</strong> Vendor registrations require admin approval. 
                            You will receive an email notification once your account is approved and activated.
                        </p>
                    </div>

                    <!-- Register Button -->
                    <div>
                        <button type="submit" 
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-purple-500 group-hover:text-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            Submit Registration for Approval
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-sm text-purple-100">
                            Already have an account? 
                            <a href="/login/vendor" class="font-medium text-purple-300 hover:text-purple-200 underline">
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
                <p class="text-sm text-purple-100 mb-3">Register as different user type:</p>
                <div class="flex justify-center space-x-2 flex-wrap">
                    <a href="/customer/register" 
                       class="px-3 py-1 text-xs rounded bg-white/20 text-purple-100 hover:bg-white/30 transition-colors">
                        Customer
                    </a>
                    <a href="/service-station/register" 
                       class="px-3 py-1 text-xs rounded bg-white/20 text-purple-100 hover:bg-white/30 transition-colors">
                        Service Station
                    </a>
                    <a href="/vendor/register" 
                       class="px-3 py-1 text-xs rounded bg-purple-500 text-white transition-colors">
                        Vendor
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>