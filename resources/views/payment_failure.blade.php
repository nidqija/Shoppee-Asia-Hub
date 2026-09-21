<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f6f6f6]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Unsuccessful - ShopeeAsia</title>

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

<body class="min-h-full font-sans antialiased text-gray-800 flex flex-col justify-between">

    <!-- Top Utility Bar -->
    <div class="bg-shopee text-white text-xs py-1.5 px-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4 text-[11px] opacity-90">
                <span>🔒 Secure Checkout</span>
                <span>•</span>
                <span>Shopee Buyer Protection</span>
            </div>
            <div class="flex items-center gap-4 text-[11px]">
                <a href="{{ url('/seller-home') }}" class="hover:underline opacity-90">Seller Centre</a>
                <a href="{{ url('/home') }}" class="hover:underline font-semibold">User Home</a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="w-full bg-white border-b border-gray-200 sticky top-0 z-40 shadow-xs">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4">
                <a href="{{ url('/home') }}" class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-lg bg-shopee text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">ShopeeAsia</span>
                </a>
                <div class="h-6 w-px bg-gray-300"></div>
                <h1 class="text-lg font-medium text-gray-800">Payment Status</h1>
            </div>

            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-orange-100 text-shopee flex items-center justify-center font-bold text-xs">
                    U
                </div>
                <span class="text-xs font-semibold text-gray-700 hidden sm:inline" id="userEmailBadge">buyer@shoppee.com</span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-2xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-8 text-center">
            <div class="w-20 h-20 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-5 ring-8 ring-red-50">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200 mb-3">
                Transaction Incomplete
            </span>

            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Payment Unsuccessful</h2>
            <p class="text-sm text-gray-500 mt-2 max-w-md mx-auto">
                We couldn't process your payment. This could be due to a cancelled transaction, network timeout, or card issuer decline. No funds were captured.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
                <button type="button" onclick="window.history.back()" class="w-full sm:w-auto px-6 py-3 bg-shopee hover:bg-shopee-hover text-white font-bold text-xs rounded-xl shadow-xs transition">
                    Try Again
                </button>
                <a href="{{ url('/home') }}" class="w-full sm:w-auto px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs rounded-xl transition text-center">
                    Return to Marketplace
                </a>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500 mt-12">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p>&copy; {{ date('Y') }} ShopeeAsia Marketplace. Genuine regional inventory guaranteed.</p>
            <div class="flex items-center gap-4 text-gray-400">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms of Service</a>
                <a href="#" class="hover:underline">Help Centre</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const storedEmail = localStorage.getItem("user_email") || "buyer@shoppee.com";
            const emailBadge = document.getElementById("userEmailBadge");
            if (emailBadge) {
                emailBadge.textContent = storedEmail;
            }
        });
    </script>
</body>

</html>
