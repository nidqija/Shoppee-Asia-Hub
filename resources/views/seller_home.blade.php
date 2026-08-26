<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f6f6f6]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Seller Centre - ShopeeAsia</title>

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
        
        <!-- Header -->
        <header class="w-full bg-white border-b border-gray-200 sticky top-0 z-50 shadow-xs">
            <div class="max-w-7xl mx-auto flex items-center justify-between py-3 px-4 sm:px-6 lg:px-8">
                
                <!-- Brand & Shard Badge -->
                <div class="flex items-center gap-3">
                    <a href="#" class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-lg bg-shopee text-white flex items-center justify-center font-bold text-lg shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-gray-900">ShopeeAsia</span>
                    </a>
                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-orange-100 text-shopee uppercase">
                        Seller Centre
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200 font-mono">
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> shard_my (Port 5430)
                    </span>
                </div>

                <!-- Seller Profile & Shard Info -->
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-semibold text-gray-900 leading-tight">TechGadgets MY Store</p>
                        <p class="text-[11px] text-gray-500 font-mono leading-tight">Merchant UUID: 0195-my-8841</p>
                    </div>

                    <a href="{{ url('/') }}" class="text-xs font-semibold text-gray-600 hover:text-shopee border border-gray-200 hover:border-shopee px-3 py-1.5 rounded-md transition">
                        Sign Out
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
            
            <!-- Store Shard Overview Banner -->
            <div class="bg-gradient-to-r from-orange-500 via-shopee to-red-600 rounded-2xl p-6 text-white shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur mb-2">
                        📍 Region Partition: Malaysia (MYR)
                    </span>
                    <h1 class="text-2xl font-extrabold tracking-tight">TechGadgets Official Store</h1>
                    <p class="text-xs text-white/90 mt-1 max-w-xl">
                        Your products, merchant records, and order line items are isolated strictly on the <code class="bg-black/20 px-1 py-0.5 rounded">shoppee-shard-my</code> database.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <button class="bg-white text-shopee hover:bg-orange-50 text-xs font-bold px-4 py-2.5 rounded-lg shadow-sm transition">
                        + Add New Product
                    </button>
                    <button class="bg-white/20 hover:bg-white/30 text-white text-xs font-bold px-4 py-2.5 rounded-lg backdrop-blur transition">
                        Store Settings
                    </button>
                </div>
            </div>

            <!-- Shard Business Metrics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Shard Revenue</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">MYR 18,420.50</p>
                    <p class="text-[11px] text-emerald-600 font-medium mt-1">↑ 12.4% this month</p>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Active Shard Products</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">24</p>
                    <p class="text-[11px] text-gray-500 mt-1">In <code class="text-gray-700">shard_my.products</code></p>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Pending Orders</p>
                    <p class="text-2xl font-black text-shopee mt-1">7</p>
                    <p class="text-[11px] text-orange-600 font-medium mt-1">Requires fulfillment</p>
                </div>

                <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Target DB Shard</p>
                    <p class="text-2xl font-black text-blue-600 mt-1">shard_my</p>
                    <p class="text-[11px] text-gray-400 mt-1">PostgreSQL Local Shard</p>
                </div>
            </div>

            <!-- Shard Product Inventory Table -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-gray-50/50">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Your Shard Inventory</h2>
                        <p class="text-xs text-gray-500">Live products stored on <code class="font-mono text-gray-700">shoppee-shard-my.products</code></p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold text-gray-500">Filter Category:</span>
                        <select class="bg-white border border-gray-300 text-gray-800 text-xs font-semibold py-1.5 px-3 rounded-lg focus:outline-none">
                            <option>All Categories</option>
                            <option>Electronics</option>
                            <option>Accessories</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-gray-100/75 border-b border-gray-200 text-gray-600 font-semibold uppercase tracking-wider">
                                <th class="py-3 px-4">SKU / Shard ID</th>
                                <th class="py-3 px-4">Product Title</th>
                                <th class="py-3 px-4">Category</th>
                                <th class="py-3 px-4">Price (MYR)</th>
                                <th class="py-3 px-4">Stock Level</th>
                                <th class="py-3 px-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-4 font-mono font-bold text-gray-500">0195-PRD-01</td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-gray-900">Wireless Noise-Canceling Headphones</div>
                                    <div class="text-[11px] text-gray-400">High-fidelity audio with 40-hour battery</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 bg-gray-100 rounded text-[11px] font-semibold">electronics</span>
                                </td>
                                <td class="py-3.5 px-4 font-bold text-shopee">MYR 349.00</td>
                                <td class="py-3.5 px-4 font-semibold text-emerald-600">85 in stock</td>
                                <td class="py-3.5 px-4 text-right">
                                    <button class="text-shopee hover:underline font-bold">Edit</button>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-4 font-mono font-bold text-gray-500">0195-PRD-02</td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-gray-900">Premium Cotton Oversized T-Shirt</div>
                                    <div class="text-[11px] text-gray-400">100% combed cotton, 240 GSM breathable fabric</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 bg-gray-100 rounded text-[11px] font-semibold">fashion</span>
                                </td>
                                <td class="py-3.5 px-4 font-bold text-shopee">MYR 59.90</td>
                                <td class="py-3.5 px-4 font-semibold text-emerald-600">140 in stock</td>
                                <td class="py-3.5 px-4 text-right">
                                    <button class="text-shopee hover:underline font-bold">Edit</button>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-4 font-mono font-bold text-gray-500">0195-PRD-03</td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-gray-900">USB-C Fast Charging Cable (2M)</div>
                                    <div class="text-[11px] text-gray-400">Braided nylon, 100W Power Delivery support</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2 py-0.5 bg-gray-100 rounded text-[11px] font-semibold">accessories</span>
                                </td>
                                <td class="py-3.5 px-4 font-bold text-shopee">MYR 25.00</td>
                                <td class="py-3.5 px-4 font-semibold text-amber-600">12 low stock</td>
                                <td class="py-3.5 px-4 text-right">
                                    <button class="text-shopee hover:underline font-bold">Edit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-3.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between text-xs text-gray-500">
                    <span>Showing 3 of 24 products on <strong>shard_my</strong></span>
                    <span>Database: shoppee-shard-my:5430</span>
                </div>
            </div>

        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                <p>&copy; {{ date('Y') }} ShopeeAsia Seller Centre. Multi-Region Sharded Architecture.</p>
                <p class="text-gray-400">Current Shard: <code class="text-gray-600">shard_my</code></p>
            </div>
        </footer>
    </body>
</html>