<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auto Service Platform - Connect. Service. Deliver.</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen gradient-bg">
        <!-- Navigation -->
        <nav class="bg-white/10 backdrop-blur-md border-b border-white/20 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <h1 class="text-white text-xl font-bold">🚗 Auto Service Platform</h1>
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

        <!-- Hero Section -->
        <div class="relative px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                    <span class="block">Your Complete</span>
                    <span class="block text-yellow-300">Auto Service Solution</span>
                </h1>
                <p class="max-w-md mx-auto mt-3 text-base text-blue-100 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Connect vehicle owners, service stations, and parts vendors in one comprehensive platform. 
                    Experience seamless automotive services with transparent pricing and real-time tracking.
                </p>
                <div class="max-w-md mx-auto mt-5 sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="#get-started" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-purple-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition-colors">
                            Get Started
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#features" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 md:py-4 md:text-lg md:px-10 transition-colors">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Type Cards -->
            <div id="get-started" class="mt-20 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Customer Card -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20 card-hover">
                    <div class="text-center">
                        <div class="text-5xl mb-4">👤</div>
                        <h3 class="text-xl font-semibold text-white mb-2">For Vehicle Owners</h3>
                        <p class="text-blue-100 mb-6 text-sm">Book services, track vehicle history, order parts, and connect with trusted service providers.</p>
                        <div class="space-y-3">
                            <a href="/customer/register" 
                               class="block w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-lg transition-colors shadow-lg">
                                🚀 Register as Customer
                            </a>
                            <a href="/login/customer" 
                               class="block w-full bg-transparent border-2 border-green-300 text-green-300 hover:bg-green-300 hover:text-green-800 font-medium py-2 px-4 rounded-lg transition-colors">
                                Already have account? Login
                            </a>
                        </div>
                        <div class="mt-4 text-xs text-blue-200">
                            ✓ Instant activation • ✓ Free to join
                        </div>
                    </div>
                </div>

                <!-- Service Station Card -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20 card-hover">
                    <div class="text-center">
                        <div class="text-5xl mb-4">🔧</div>
                        <h3 class="text-xl font-semibold text-white mb-2">For Service Stations</h3>
                        <p class="text-blue-100 mb-6 text-sm">Manage appointments, staff, inventory, and grow your business with our comprehensive platform.</p>
                        <div class="space-y-3">
                            <a href="/service-station/register" 
                               class="block w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-lg transition-colors shadow-lg">
                                🏢 Register Your Station
                            </a>
                            <a href="/login/service-station" 
                               class="block w-full bg-transparent border-2 border-orange-300 text-orange-300 hover:bg-orange-300 hover:text-orange-800 font-medium py-2 px-4 rounded-lg transition-colors">
                                Station Login
                            </a>
                        </div>
                        <div class="mt-4 text-xs text-blue-200">
                            ⏳ Requires approval • 📋 Business verification
                        </div>
                    </div>
                </div>

                <!-- Vendor Card -->
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-6 border border-white/20 card-hover">
                    <div class="text-center">
                        <div class="text-5xl mb-4">🛠️</div>
                        <h3 class="text-xl font-semibold text-white mb-2">For Parts Vendors</h3>
                        <p class="text-blue-100 mb-6 text-sm">Sell parts, manage inventory, fulfill orders, and reach customers across the platform.</p>
                        <div class="space-y-3">
                            <a href="/vendor/register" 
                               class="block w-full bg-purple-500 hover:bg-purple-600 text-white font-medium py-3 px-4 rounded-lg transition-colors shadow-lg">
                                🛒 Become a Vendor
                            </a>
                            <a href="/login/vendor" 
                               class="block w-full bg-transparent border-2 border-purple-300 text-purple-300 hover:bg-purple-300 hover:text-purple-800 font-medium py-2 px-4 rounded-lg transition-colors">
                                Vendor Login
                            </a>
                        </div>
                        <div class="mt-4 text-xs text-blue-200">
                            ⏳ Requires approval • 💼 Business registration
                        </div>
                    </div>
                </div>
            </div>

            <!-- Platform Benefits -->
            <div class="mt-24 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Why Choose Our Platform?</h2>
                <p class="text-blue-100 mb-12 max-w-2xl mx-auto">
                    We bring together the entire automotive service ecosystem in one place, 
                    making it easier for everyone to connect, collaborate, and grow.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl mb-4">🚀</div>
                        <h4 class="text-white font-semibold mb-2">Fast & Efficient</h4>
                        <p class="text-blue-100 text-sm">Streamlined processes for quick service booking and parts ordering</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-4">🔒</div>
                        <h4 class="text-white font-semibold mb-2">Secure & Trusted</h4>
                        <p class="text-blue-100 text-sm">Verified service providers and secure payment processing</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-4">📱</div>
                        <h4 class="text-white font-semibold mb-2">Mobile Ready</h4>
                        <p class="text-blue-100 text-sm">Access your account and services from any device, anywhere</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-4">🤝</div>
                        <h4 class="text-white font-semibold mb-2">Connected Network</h4>
                        <p class="text-blue-100 text-sm">Vast network of service stations, vendors, and customers</p>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="mt-24">
                <h2 class="text-3xl font-bold text-center text-white mb-12">Platform Features</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Customer Features -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 border border-white/10">
                        <div class="text-green-400 text-2xl mb-3">👤 Customer Features</div>
                        <ul class="text-blue-100 text-sm space-y-2">
                            <li>• Vehicle management and history tracking</li>
                            <li>• Service appointment booking</li>
                            <li>• Parts ordering and delivery tracking</li>
                            <li>• Service provider reviews and ratings</li>
                            <li>• Digital invoices and payment history</li>
                            <li>• Expert consultation scheduling</li>
                        </ul>
                    </div>

                    <!-- Service Station Features -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 border border-white/10">
                        <div class="text-orange-400 text-2xl mb-3">🔧 Service Station Features</div>
                        <ul class="text-blue-100 text-sm space-y-2">
                            <li>• Appointment and scheduling management</li>
                            <li>• Staff and service bay organization</li>
                            <li>• Inventory and parts management</li>
                            <li>• Customer communication tools</li>
                            <li>• Business analytics and reporting</li>
                            <li>• Quality control and tracking</li>
                        </ul>
                    </div>

                    <!-- Vendor Features -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 border border-white/10">
                        <div class="text-purple-400 text-2xl mb-3">🛠️ Vendor Features</div>
                        <ul class="text-blue-100 text-sm space-y-2">
                            <li>• Parts catalog and inventory management</li>
                            <li>• Order processing and fulfillment</li>
                            <li>• Pricing and promotion management</li>
                            <li>• Shipping and logistics tracking</li>
                            <li>• Sales analytics and reporting</li>
                            <li>• Customer relationship management</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-24 text-center">
                <div class="bg-white/10 backdrop-blur-md rounded-lg p-8 border border-white/20">
                    <h2 class="text-2xl font-bold text-white mb-4">Ready to Get Started?</h2>
                    <p class="text-blue-100 mb-6">Join thousands of users already using our platform to manage their automotive needs.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="/customer/register" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                            Register as Customer
                        </a>
                        <a href="/service-station/register" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                            Register Service Station
                        </a>
                        <a href="/vendor/register" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                            Become a Vendor
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-black/20 border-t border-white/20 mt-20">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Platform Info -->
                    <div class="col-span-1 md:col-span-2">
                        <h3 class="text-white font-bold text-lg mb-4">🚗 Auto Service Platform</h3>
                        <p class="text-blue-100 text-sm mb-4">
                            The complete automotive service ecosystem bringing together vehicle owners, 
                            service stations, and parts vendors in one integrated platform.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-blue-300 hover:text-white text-sm transition-colors">Privacy Policy</a>
                            <a href="#" class="text-blue-300 hover:text-white text-sm transition-colors">Terms of Service</a>
                            <a href="#" class="text-blue-300 hover:text-white text-sm transition-colors">Support</a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Quick Access</h4>
                        <div class="space-y-2">
                            <a href="/login/customer" class="block text-blue-300 hover:text-white text-sm transition-colors">Customer Login</a>
                            <a href="/login/service-station" class="block text-blue-300 hover:text-white text-sm transition-colors">Service Station</a>
                            <a href="/login/vendor" class="block text-blue-300 hover:text-white text-sm transition-colors">Vendor Portal</a>
                            <a href="/login/admin" class="block text-blue-300 hover:text-white text-sm transition-colors">Admin Access</a>
                        </div>
                    </div>

                    <!-- Registration Links -->
                    <div>
                        <h4 class="text-white font-semibold mb-4">Join Platform</h4>
                        <div class="space-y-2">
                            <a href="/customer/register" class="block text-green-300 hover:text-white text-sm transition-colors">Register as Customer</a>
                            <a href="/service-station/register" class="block text-orange-300 hover:text-white text-sm transition-colors">Register Service Station</a>
                            <a href="/vendor/register" class="block text-purple-300 hover:text-white text-sm transition-colors">Become a Vendor</a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-white/20 mt-8 pt-8 text-center">
                    <p class="text-blue-100 text-sm">© 2025 Auto Service Platform. Built with Laravel & Filament. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Smooth scrolling script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>