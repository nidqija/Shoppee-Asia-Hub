<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f6f6f6]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ergonomic Mechanical Keyboard - ShopeeAsia</title>

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
                @if ($product->region_code == "MY")
                    <span>📍 Regional Hub : Malaysia {{ $product->region_code }}</span>
                @endif
                <span>•</span>
                <span>Free Shipping over RM 40</span>
            </div>
            <div class="flex items-center gap-4 text-[11px]">
                <a href="{{ url('/seller-home') }}" class="hover:underline opacity-90">Seller Centre</a>
                <a href="{{ url('/home') }}" class="hover:underline font-semibold">User Home</a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="w-full bg-white border-b border-gray-200 sticky top-0 z-40 shadow-xs">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-3.5 px-4 sm:px-6 lg:px-8 gap-4">

            <!-- Brand Logo -->
            <a href="{{ url('/home') }}" class="flex items-center gap-2 flex-shrink-0">
                <div class="w-9 h-9 rounded-lg bg-shopee text-white flex items-center justify-center font-bold text-lg shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-gray-900">ShopeeAsia</span>
            </a>

            <!-- Search Bar -->
            <div class="flex-1 max-w-2xl hidden md:block">
                <div class="relative flex items-center">
                    <input type="text" readonly value="Ergonomic mechanical keyboards, keycaps & switches"
                        class="w-full text-xs pl-3 pr-24 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-700 outline-none cursor-default" />
                    <button type="button" class="absolute right-1 px-4 py-1.5 bg-shopee text-white text-xs font-semibold rounded-md shadow-xs">
                        Search
                    </button>
                </div>
            </div>

            <!-- Customer Actions -->
            <div class="flex items-center gap-4">
                <div class="relative p-2 text-gray-600 hover:text-shopee cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute top-1 right-1 bg-shopee text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                        2
                    </span>
                </div>

                <div class="flex items-center gap-2 pl-2 border-l border-gray-200">
                    <div class="w-7 h-7 rounded-full bg-orange-100 text-shopee flex items-center justify-center font-bold text-xs">
                        U
                    </div>
                    <span class="text-xs font-semibold text-gray-700 hidden sm:inline">customer@example.com</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-gray-500">
            <a href="{{ url('/home') }}" class="hover:text-shopee">Home</a>
            <span>/</span>
            <span class="hover:text-shopee">{{ $product->category_slug }}</span>
            <span>/</span>
            <span class="text-gray-900 font-medium truncate max-w-xs sm:max-w-md">{{ $product->title }}</span>
        </nav>

        <!-- Product Primary Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-6 grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left: Product Media Gallery -->
            <div class="lg:col-span-5 space-y-3">
                <div class="w-full aspect-square bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center relative overflow-hidden">
                    <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 10h.01M12 10h.01M16 10h.01M8 14h.01M12 14h.01M16 14h.01" />
                    </svg>
                    <span class="absolute top-3 left-3 bg-shopee text-white text-[10px] font-bold px-2 py-0.5 rounded">
                        OFFICIAL STORE
                    </span>
                </div>

                <!-- Media Thumbnails -->
                <div class="grid grid-cols-4 gap-2">
                    <div class="aspect-square rounded-lg border-2 border-shopee bg-gray-50 flex items-center justify-center p-1">
                        <div class="w-full h-full bg-orange-50/50 rounded flex items-center justify-center text-[10px] font-mono text-shopee">1</div>
                    </div>
                    <div class="aspect-square rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center p-1">
                        <div class="w-full h-full bg-white rounded flex items-center justify-center text-[10px] font-mono text-gray-400">2</div>
                    </div>
                    <div class="aspect-square rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center p-1">
                        <div class="w-full h-full bg-white rounded flex items-center justify-center text-[10px] font-mono text-gray-400">3</div>
                    </div>
                    <div class="aspect-square rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center p-1">
                        <div class="w-full h-full bg-white rounded flex items-center justify-center text-[10px] font-mono text-gray-400">4</div>
                    </div>
                </div>
            </div>

            <!-- Right: Product Information & Purchase Panel -->
            <div class="lg:col-span-7 flex flex-col justify-between space-y-6">

                <div class="space-y-4">
                    <!-- Title & Badges -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 bg-orange-100 text-shopee rounded text-[11px] font-bold uppercase tracking-wide">
                                Preferred
                            </span>
                            <span class="text-xs text-gray-400 font-mono">SKU: PRD-8A4F12E9</span>
                        </div>
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-900 leading-snug">
                            {{ $product->title }}
                        </h1>
                    </div>

                    <!-- Reviews & Ratings Strip -->
                    <div class="flex flex-wrap items-center gap-4 text-xs pb-3 border-b border-gray-100">
                        <div class="flex items-center gap-1 text-shopee font-bold">
                            <span class="underline text-sm">4.9</span>
                            <div class="flex text-shopee">★★★★★</div>
                        </div>
                        <span class="text-gray-300">|</span>
                        <div class="text-gray-600">
                            <span class="font-bold text-gray-900">428</span> Ratings
                        </div>
                        <span class="text-gray-300">|</span>
                        <div class="text-gray-600">
                            <span class="font-bold text-gray-900">1.2k</span> Sold
                        </div>
                    </div>

                    <!-- Price Section -->
                    <div class="bg-gray-50/80 rounded-xl p-4 flex items-baseline gap-3">
                        <span class="text-3xl font-extrabold text-shopee">RM {{ $product->price }}</span>
                        <span class="text-xs text-gray-400 line-through">RM 329.00</span>
                        <span class="text-xs font-bold text-shopee bg-orange-100 px-2 py-0.5 rounded">-24%</span>
                    </div>

                    <!-- Variations & Options -->
                    <div class="space-y-3 pt-2 text-xs">
                        <div class="flex items-center">
                            <span class="w-24 text-gray-500 font-medium">Switch Type</span>
                            <div class="flex gap-2 flex-wrap">
                                <button type="button" class="px-3 py-1.5 border border-shopee text-shopee bg-orange-50/40 rounded-md font-semibold cursor-default">
                                    Linear Red
                                </button>
                                <button type="button" class="px-3 py-1.5 border border-gray-200 text-gray-700 bg-white rounded-md hover:border-gray-300 cursor-default">
                                    Tactile Brown
                                </button>
                                <button type="button" class="px-3 py-1.5 border border-gray-200 text-gray-700 bg-white rounded-md hover:border-gray-300 cursor-default">
                                    Clicky Blue
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <span class="w-24 text-gray-500 font-medium">Shipping</span>
                            <div class="space-y-1 text-gray-700">
                                <p class="font-medium flex items-center gap-1.5">
                                    <span>🚚 Standard Delivery: <strong class="text-emerald-600">Free</strong></span>
                                </p>
                                <p class="text-[11px] text-gray-400">Direct dispatch from Selangor Hub • Guaranteed delivery within 2-3 days</p>
                            </div>
                        </div>

                        <div class="flex items-center pt-2">
                            <span class="w-24 text-gray-500 font-medium">Quantity</span>
                            <div class="flex items-center gap-3">
                                <div class="inline-flex items-center border border-gray-200 rounded-md bg-white">
                                    <span class="px-3 py-1 text-gray-400 cursor-default">−</span>
                                    <span class="px-3 py-1 font-semibold text-gray-800 border-x border-gray-200">1</span>
                                    <span class="px-3 py-1 text-gray-700 cursor-default">+</span>
                                </div>
                                <span class="text-gray-400 text-[11px]">{{ $product->stock_quantity }} units available</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call to Action Buttons -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-4 border-t border-gray-100">
                    <button type="button" class="w-full sm:flex-1 py-3 px-6 bg-shopee-light text-shopee border border-shopee font-bold text-xs rounded-xl hover:bg-orange-100 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Add To Cart
                    </button>
                    <button type="button" class="w-full sm:flex-1 py-3 px-6 bg-shopee text-white font-bold text-xs rounded-xl hover:bg-shopee-hover shadow-sm transition">
                        Buy Now
                    </button>
                </div>

            </div>

        </div>

        <!-- Store Information Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-5 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-orange-100 text-shopee flex items-center justify-center font-bold text-lg flex-shrink-0">
                    O
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-sm font-bold text-gray-900">{{ $product->seller?->email ?? 'Unknown Seller' }}</h2>
                        <span class="px-2 py-0.2 rounded bg-shopee text-white text-[10px] font-semibold">Mall</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-0.5">Active 12 minutes ago • Certified Merchant</p>
                </div>
            </div>

            <div class="flex items-center gap-6 text-xs text-gray-600 border-t md:border-t-0 pt-3 md:pt-0 border-gray-100">
                <div>
                    <span class="text-gray-400">Products:</span>
                    <span class="font-bold text-gray-800 ml-1">142</span>
                </div>
                <div>
                    <span class="text-gray-400">Rating:</span>
                    <span class="font-bold text-shopee ml-1">4.9 / 5.0</span>
                </div>
                <div>
                    <span class="text-gray-400">Response Rate:</span>
                    <span class="font-bold text-gray-800 ml-1">98%</span>
                </div>
            </div>
        </div>

        <!-- Product Specifications & Details Tabs -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-6 space-y-6">

            <!-- Section 1: Specifications -->
            <div class="space-y-3">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Product Specifications</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-8 text-xs">
                    <div class="flex">
                        <span class="w-32 text-gray-400">Category</span>
                        <span class="text-gray-800 font-medium">{{ $product->category_slug }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-400">Warranty Period</span>
                        <span class="text-gray-800 font-medium">12 Months Local Supplier</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-400">Connectivity</span>
                        <span class="text-gray-800 font-medium">Bluetooth 5.1 / 2.4GHz / Type-C</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-400">Stock Location</span>
                        <span class="text-gray-800 font-medium">Subang Jaya, Selangor</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-400">Switch Type</span>
                        <span class="text-gray-800 font-medium">Hot-Swappable 5-Pin PCB</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 text-gray-400">Battery Capacity</span>
                        <span class="text-gray-800 font-medium">4000mAh Rechargeable</span>
                    </div>
                </div>
            </div>

            <hr class="border-gray-100" />

            <!-- Section 2: Detailed Description -->
            <div class="space-y-3 text-xs leading-relaxed text-gray-700">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Product Description</h3>
                <p>
                    {{ $product->description }}
                </p>
                <div class="space-y-1.5 pl-4 list-disc">
                    <p>• <strong>Factory Lubed Switches:</strong> Ultra-smooth linear switches out of the box with zero ping or scratchiness.</p>
                    <p>• <strong>Gasket Mount Design:</strong> Multi-layer dampening foam and silicone padding deliver a muted, satisfying bottom-out acoustic signature.</p>
                    <p>• <strong>Per-Key RGB Backlighting:</strong> 18 dynamic lighting modes with full brightness and speed adjustability.</p>
                    <p>• <strong>Cross-Platform Compatibility:</strong> Seamless toggle switch between macOS and Windows layouts.</p>
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p>&copy; {{ date('Y') }} ShopeeAsia Marketplace. Genuine regional inventory guaranteed.</p>
            <div class="flex items-center gap-4 text-gray-400">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms of Service</a>
                <a href="#" class="hover:underline">Help Centre</a>
            </div>
        </div>
    </footer>

</body>

</html>