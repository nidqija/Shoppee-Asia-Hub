<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f6f6f6]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Store') }} - Sign In & Register</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            shopee: {
                                DEFAULT: '#ee4d2d',
                                hover: '#d73211',
                                light: '#fef3f0'
                            }
                        },
                        fontFamily: {
                            sans: ['Instrument Sans', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    </head>

    <body class="h-full font-sans antialiased text-gray-800 flex flex-col justify-between">
        
        <!-- Header -->
        <header class="w-full bg-white border-b border-gray-200 py-4 px-6 md:px-12">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <!-- Brand Logo -->
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-lg bg-shopee text-white flex items-center justify-center font-bold text-xl shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-gray-900">{{ config('app.name', 'ShopMart') }}</span>
                    </a>
                    <span class="hidden md:inline-block text-xl font-medium text-gray-700 pl-4 border-l border-gray-300" id="headerTitle">
                        Sign In
                    </span>
                </div>

                <a href="https://help.shopee.com" target="_blank" class="text-sm font-medium text-shopee hover:underline">
                    Need help?
                </a>
            </div>
        </header>

        <!-- Main Banner & Auth Container -->
        <main class="flex-grow flex items-center justify-center bg-gradient-to-r from-orange-500 via-shopee to-red-600 px-4 py-8 md:py-12">
            <div class="max-w-7xl w-full mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <!-- Left Column: E-commerce Promo / Illustration (Desktop only) -->
                <div class="hidden lg:flex lg:col-span-7 flex-col text-white px-5">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-extrabold tracking-tight mb-3">Shop Everything You Love</h1>
                    <p class="text-lg text-white/90 max-w-lg mb-8 leading-relaxed">
                        Enjoy free nationwide shipping, voucher drops every midnight, and guaranteed buyer security on every checkout.
                    </p>

                    <!-- Trust Badges -->
                    <div class="grid grid-cols-3 gap-4 pt-4 border-t border-white/20">
                        <div class="flex items-center gap-2">
                            <span class="p-2 bg-white/10 rounded-full">✓</span>
                            <span class="text-sm font-medium">100% Authentic</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="p-2 bg-white/10 rounded-full">⚡</span>
                            <span class="text-sm font-medium">Fast Delivery</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="p-2 bg-white/10 rounded-full">🛡️</span>
                            <span class="text-sm font-medium">Safe Checkout</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Authentication Card -->
                <div class="lg:col-span-5 w-full max-w-md mx-auto">
                    <div class="bg-white rounded-xl shadow-2xl p-6 sm:p-8 border border-gray-100">
                        
                        <!-- Card Tabs -->
                        <div class="flex items-center justify-between border-b border-gray-200 mb-6 pb-3">
                            <h2 class="text-xl font-bold text-gray-900" id="formHeader">Log In</h2>
                            <button type="button" onclick="toggleForm()" class="text-sm font-semibold text-shopee hover:text-shopee-hover focus:outline-none" id="toggleButton">
                                New here? Sign Up
                            </button>
                        </div>

                        <!-- Sign In Form -->
                        <form >
                            @csrf
                            <div>
                                <label for="login-email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Email or Phone Number</label>
                                <input id="login-email" type="text" name="email" value="{{ old('email') }}" required autofocus
                                    class="w-full mb-5 px-3.5 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee focus:border-transparent transition"
                                    placeholder="name@example.com">
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label for="login-password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-xs text-shopee hover:underline">Forgot password?</a>
                                    @endif
                                </div>
                                <input id="login-password" type="password" name="password" required
                                    class="w-full mb-5 px-3.5 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee focus:border-transparent transition"
                                    placeholder="••••••••">
                            </div>

                            <div class="flex items-center mb-5">
                                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-shopee focus:ring-shopee border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-xs text-gray-600">Remember this device</label>
                            </div>

                            <button type="submit" class="w-full bg-shopee hover:bg-shopee-hover text-white font-semibold py-3 px-4 rounded-lg shadow uppercase text-sm tracking-wide transition duration-150 ease-in-out">
                                Log In
                            </button>
                        </form>

                        <!-- Sign Up Form (Hidden by default) -->
                        <form  class="space-y-4 hidden">
                            @csrf
                            <div>
                                <label for="reg-name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Full Name</label>
                                <input id="reg-name" type="text" name="name" value="{{ old('name') }}" required
                                    class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee focus:border-transparent transition"
                                    placeholder="Jane Doe">
                            </div>

                            <div>
                                <label for="reg-email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Email Address</label>
                                <input id="reg-email" type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee focus:border-transparent transition"
                                    placeholder="name@example.com">
                            </div>

                            <div>
                                <label for="reg-password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Password</label>
                                <input id="reg-password" type="password" name="password" required
                                    class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee focus:border-transparent transition"
                                    placeholder="At least 8 characters">
                            </div>

                            <div>
                                <label for="reg-confirm" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Confirm Password</label>
                                <input id="reg-confirm" type="password" name="password_confirmation" required
                                    class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee focus:border-transparent transition"
                                    placeholder="Repeat password">
                            </div>

                            <button type="submit" class="w-full bg-shopee hover:bg-shopee-hover text-white font-semibold py-3 px-4 rounded-lg shadow uppercase text-sm tracking-wide transition duration-150 ease-in-out">
                                Create Account
                            </button>
                        </form>

                        <!-- Social Divider -->
                        <div class="mt-6 relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-xs uppercase">
                                <span class="bg-white px-2 text-gray-500 font-medium">Or continue with</span>
                            </div>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <button type="button" class="flex items-center justify-center gap-2 border border-gray-300 py-2.5 px-4 rounded-lg text-xs font-semibold text-gray-700 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.665-5.17 3.665-9.17z"/>
                                    <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/>
                                    <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.18 0 10.03 0 12s.45 3.82 1.25 5.42l4.03-3.15z"/>
                                    <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                                </svg>
                                Google
                            </button>
                            <button type="button" class="flex items-center justify-center gap-2 border border-gray-300 py-2.5 px-4 rounded-lg text-xs font-semibold text-gray-700 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 text-blue-600 fill-current" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                Facebook
                            </button>
                        </div>

                        <!-- Terms of Service -->
                        <p class="mt-6 text-center text-xs text-gray-500 leading-relaxed">
                            By continuing, you agree to our 
                            <a href="#" class="text-shopee underline">Terms of Service</a> & 
                            <a href="#" class="text-shopee underline">Privacy Policy</a>.
                        </p>
                    </div>
                </div>

            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'ShopMart') }}. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:underline">About Us</a>
                    <a href="#" class="hover:underline">Buyer Protection</a>
                    <a href="#" class="hover:underline">Seller Centre</a>
                    <a href="#" class="hover:underline">Contact</a>
                </div>
            </div>
        </footer>

        <!-- Form Toggle Script -->
        <script>
            let isLogin = true;
            function toggleForm() {
                isLogin = !isLogin;
                const loginForm = document.getElementById('loginForm');
                const regForm = document.getElementById('registerForm');
                const formHeader = document.getElementById('formHeader');
                const headerTitle = document.getElementById('headerTitle');
                const toggleBtn = document.getElementById('toggleButton');

                if (isLogin) {
                    loginForm.classList.remove('hidden');
                    regForm.classList.add('hidden');
                    formHeader.textContent = 'Log In';
                    if (headerTitle) headerTitle.textContent = 'Sign In';
                    toggleBtn.textContent = 'New here? Sign Up';
                } else {
                    loginForm.classList.add('hidden');
                    regForm.classList.remove('hidden');
                    formHeader.textContent = 'Sign Up';
                    if (headerTitle) headerTitle.textContent = 'Register';
                    toggleBtn.textContent = 'Already have an account? Log In';
                }
            }
        </script>
    </body>
</html>