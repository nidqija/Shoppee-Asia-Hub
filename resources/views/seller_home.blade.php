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

    <!-- Toast Notification -->
    <div id="toastNotification" class="fixed top-4 right-4 z-50 transform transition-all duration-300 translate-y-[-100%] opacity-0 pointer-events-none">
        <div id="toastContent" class="flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg border text-xs font-semibold">
        </div>
    </div>

    <!-- Header -->
    <header class="w-full bg-white border-b border-gray-200 sticky top-0 z-40 shadow-xs">
        <div class="max-w-7xl mx-auto flex items-center justify-between py-3 px-4 sm:px-6 lg:px-8">

            <!-- Brand & Shard Badge -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/seller-home') }}" class="flex items-center gap-2">
                    <div
                        class="w-9 h-9 rounded-lg bg-shopee text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-900">ShopeeAsia</span>
                </a>
                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-orange-100 text-shopee uppercase">
                    Seller Centre
                </span>
                
            </div>

            <!-- Seller Profile & Actions -->
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p id="sellerEmail" class="text-xs font-semibold text-gray-900 leading-tight">Loading seller...</p>
                    <p id="sellerMerchantId" class="text-[11px] text-gray-500 font-mono leading-tight">Merchant UUID: --</p>
                </div>

                <a href="{{ url('/') }}" id="sellerSignOutBtn"
                    class="text-xs font-semibold text-gray-600 hover:text-shopee border border-gray-200 hover:border-shopee px-3 py-1.5 rounded-md transition cursor-pointer">
                    Sign Out
                </a>

                 <a href="{{ url('/home') }}" 
                    class="text-xs font-semibold text-orange-600 hover:text-shopee border border-gray-200 hover:border-shopee px-3 py-1.5 rounded-md transition cursor-pointer">
                    User Home
                </a>

            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        <!-- Store Shard Overview Banner -->
        <div
            class="bg-gradient-to-r from-orange-500 via-shopee to-red-600 rounded-2xl p-6 text-white shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span id="bannerRegionBadge"
                    class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur mb-2">
                    📍 Region Partition: Malaysia (MYR)
                </span>
                <h1 id="bannerStoreTitle" class="text-2xl font-extrabold tracking-tight">Official Store</h1>
                <p class="text-xs text-white/90 mt-1 max-w-xl">
                    Your products, merchant records, and order line items are isolated strictly on the <code
                        id="bannerDatabaseCode" class="bg-black/20 px-1 py-0.5 rounded font-mono">shoppee-shard-my</code> database.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button id="openModalBtn"
                    class="bg-white text-shopee hover:bg-orange-50 text-xs font-bold px-4 py-2.5 rounded-lg shadow-sm transition cursor-pointer">
                    + Add New Product
                </button>
                <button id="refreshBtn"
                    class="bg-white/20 hover:bg-white/30 text-white text-xs font-bold px-4 py-2.5 rounded-lg backdrop-blur transition cursor-pointer flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Refresh Data
                </button>
            </div>
        </div>

        <!-- Shard Business Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Inventory Value</p>
                <p id="totalRevenueMetric" class="text-2xl font-black text-gray-900 mt-1">RM 0.00</p>
                <p class="text-[11px] text-emerald-600 font-medium mt-1">Live Shard Stock Valuation</p>
            </div>

            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Active Shard Products</p>
                <p id="activeProductsCount" class="text-2xl font-black text-gray-900 mt-1">0</p>
                <p class="text-[11px] text-gray-500 mt-1">In <code id="metricShardTable" class="text-gray-700 font-mono">shard_my.products</code></p>
            </div>

            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total Units in Stock</p>
                <p id="totalUnitsCount" class="text-2xl font-black text-shopee mt-1">0</p>
                <p class="text-[11px] text-orange-600 font-medium mt-1">Across all categories</p>
            </div>

           
        </div>

        <!-- Shard Product Inventory Table -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden">
            <div
                class="p-4 sm:p-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-gray-50/50">
                <div>
                    <h2 class="text-base font-bold text-gray-900">Your Shard Inventory</h2>
                    <p class="text-xs text-gray-500">Live products stored on <code
                            id="tableSubtitleCode" class="font-mono text-gray-700">shoppee-shard-my.products</code></p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold text-gray-500">Filter Category:</span>
                    <select id="categoryFilter"
                        class="bg-white border border-gray-300 text-gray-800 text-xs font-semibold py-1.5 px-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition cursor-pointer">
                        <option value="all">All Categories</option>
                        <option value="electronics">Electronics</option>
                        <option value="accessories">Accessories</option>
                        <option value="fashion">Fashion</option>
                        <option value="home-living">Home & Living</option>
                        <option value="beauty">Health & Beauty</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr
                            class="bg-gray-100/75 border-b border-gray-200 text-gray-600 font-semibold uppercase tracking-wider">
                            <th class="py-3 px-4">SKU / Shard ID</th>
                            <th class="py-3 px-4">Product Title</th>
                            <th class="py-3 px-4">Category</th>
                            <th id="tablePriceColHeader" class="py-3 px-4">Price (MYR)</th>
                            <th class="py-3 px-4">Stock Quantity</th>
                            <th class="py-3 px-4 text-right">Status</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTableBody" class="divide-y divide-gray-200 text-gray-700">
                        <!-- Rendered dynamically by JavaScript -->
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-500">
                                <div class="inline-block animate-spin rounded-full h-7 w-7 border-4 border-shopee border-t-transparent mb-2"></div>
                                <p class="text-xs font-medium">Loading inventory from shard database...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div
                class="p-3.5 bg-gray-50 border-t border-gray-200 flex items-center justify-between text-xs text-gray-500">
                <span id="productShowingText">Showing 0 products on <strong>shard_my</strong></span>
                <span id="footerDbIndicator">Database: shoppee-shard-my:5430</span>
            </div>
        </div>

    </main>

    <!-- Add Product Modal -->
    <div id="productModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs hidden transition-opacity">
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-2xl w-full max-w-lg overflow-hidden transform transition-all">

            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Add New Shard Product</h3>
                    <p class="text-xs text-gray-500">Assign item details to <code
                            id="modalShardCode" class="font-mono text-gray-700">shard_my</code> partition</p>
                </div>
                <button id="closeModalBtn"
                    class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="addProductForm" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Product
                        Title</label>
                    <input type="text" id="prodTitle" required placeholder="e.g. Ergonomic Mechanical Keyboard"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Short
                        Description</label>
                    <input type="text" id="prodDesc" required placeholder="e.g. RGB Backlit, Hot-swappable switches"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Category</label>
                        <select id="prodCategory"
                            class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition">
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="accessories">Accessories</option>
                            <option value="home-living">Home & Living</option>
                            <option value="beauty">Health & Beauty</option>
                        </select>
                    </div>

                    <div>
                        <label id="modalPriceLabel"
                            class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Price
                            (MYR)</label>
                        <input type="number" step="0.01" min="0.01" id="prodPrice" required placeholder="0.00"
                            class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Stock</label>
                        <input type="number" min="0" id="prodStock" required placeholder="0"
                            class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition" />
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-2">
                    <button type="button" id="cancelModalBtn"
                        class="px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-lg transition cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" id="saveProductBtn"
                        class="px-5 py-2 text-xs font-bold text-white bg-shopee hover:bg-shopee-hover rounded-lg shadow-sm transition cursor-pointer flex items-center gap-1.5">
                        <span>Save to Shard</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editProductModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-xs hidden transition-opacity">
        <div
            class="bg-white rounded-2xl border border-gray-200 shadow-2xl w-full max-w-lg overflow-hidden transform transition-all">

            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Edit Shard Product</h3>
                    <p class="text-xs text-gray-500">Update item details on <code
                            id="editModalShardCode" class="font-mono text-gray-700">shard_my</code> partition</p>
                </div>
                <button id="closeEditModalBtn"
                    class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="editProductForm" class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Product Title</label>
                    <input type="text" id="editProdTitle" required placeholder="e.g. Ergonomic Mechanical Keyboard"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition" />
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Short Description</label>
                    <input type="text" id="editProdDesc" required placeholder="e.g. RGB Backlit, Hot-swappable switches"
                        class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition" />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Category</label>
                        <select id="editProdCategory"
                            class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition">
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion</option>
                            <option value="accessories">Accessories</option>
                            <option value="home-living">Home & Living</option>
                            <option value="beauty">Health & Beauty</option>
                        </select>
                    </div>

                    <div>
                        <label id="editModalPriceLabel" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Price (MYR)</label>
                        <input type="number" step="0.01" min="0.01" id="editProdPrice" required placeholder="0.00"
                            class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition" />
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Stock</label>
                        <input type="number" min="0" id="editProdStock" required placeholder="0"
                            class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:outline-none focus:ring-2 focus:ring-shopee/20 focus:border-shopee transition" />
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-2">
                    <button type="button" id="cancelEditModalBtn"
                        class="px-4 py-2 text-xs font-semibold text-gray-600 hover:bg-gray-100 rounded-lg transition cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" id="updateProductBtn"
                        class="px-5 py-2 text-xs font-bold text-white bg-shopee hover:bg-shopee-hover rounded-lg shadow-sm transition cursor-pointer flex items-center gap-1.5">
                        <span>Update Product</span>
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p>&copy; {{ date('Y') }} ShopeeAsia Seller Centre. Multi-Region Sharded Architecture.</p>
            <p class="text-gray-400">Current Shard: <code id="footerShardCode" class="text-gray-600 font-mono">shard_my</code></p>
        </div>
    </footer>

    <!-- JavaScript Data Rendering & Dynamic Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Session & Auth State Management
            const token = localStorage.getItem('auth_token');
            const rawUser = localStorage.getItem('user');
            let userObj = null;

            try {
                userObj = rawUser ? JSON.parse(rawUser) : null;
            } catch (e) {
                userObj = null;
            }

            const rawId = localStorage.getItem('id') || (userObj && userObj.id) || '';
            const rawRegion = localStorage.getItem('home_region') || (userObj && userObj.home_region) || 'MY';

            const clean_user_id = rawId ? String(rawId).replace(/^["']|["']$/g, '').trim() : '';
            const clean_home_region = (rawRegion ? String(rawRegion).replace(/^["']|["']$/g, '').trim() : 'MY').toUpperCase();

            // Redirect unauthenticated sellers to login
            if (!token || !clean_user_id) {
                console.warn('Unauthorized seller session. Redirecting to login.');
                window.location.href = "/";
                return;
            }

            // Region & Shard configuration
            const isSG = clean_home_region === 'SG';
            const shardName = isSG ? 'shard_sg' : 'shard_my';
            const shardPort = isSG ? '5431' : '5430';
            const currencyPrefix = isSG ? 'SGD' : 'MYR';
            const currencySymbol = isSG ? 'S$' : 'RM';
            const dbHost = isSG ? 'shoppee-shard-sg' : 'shoppee-shard-my';
            const regionFullName = isSG ? 'Singapore (SGD)' : 'Malaysia (MYR)';

            // 2. Populate UI Static Profile & Shard Indicators via JavaScript
            const sellerEmailEl = document.getElementById('sellerEmail');
            const sellerMerchantIdEl = document.getElementById('sellerMerchantId');
            const headerShardLabel = document.getElementById('headerShardLabel');
            const bannerRegionBadge = document.getElementById('bannerRegionBadge');
            const bannerStoreTitle = document.getElementById('bannerStoreTitle');
            const bannerDatabaseCode = document.getElementById('bannerDatabaseCode');
            const targetShardMetric = document.getElementById('targetShardMetric');
            const targetShardDbMetric = document.getElementById('targetShardDbMetric');
            const metricShardTable = document.getElementById('metricShardTable');
            const tableSubtitleCode = document.getElementById('tableSubtitleCode');
            const modalShardCode = document.getElementById('modalShardCode');
            const modalPriceLabel = document.getElementById('modalPriceLabel');
            const editModalShardCode = document.getElementById('editModalShardCode');
            const editModalPriceLabel = document.getElementById('editModalPriceLabel');
            const tablePriceColHeader = document.getElementById('tablePriceColHeader');
            const footerShardCode = document.getElementById('footerShardCode');
            const footerDbIndicator = document.getElementById('footerDbIndicator');

            if (sellerEmailEl) {
                sellerEmailEl.textContent = (userObj && userObj.email) ? userObj.email : 'Seller Store';
            }
            if (sellerMerchantIdEl) {
                sellerMerchantIdEl.textContent = `Merchant UUID: ${clean_user_id.substring(0, 16)}...`;
            }
            if (bannerStoreTitle && userObj && userObj.email) {
                const storeName = userObj.email.split('@')[0].toUpperCase();
                bannerStoreTitle.textContent = `${storeName} Store`;
            }
            if (headerShardLabel) headerShardLabel.textContent = `${shardName} (Port ${shardPort})`;
            if (bannerRegionBadge) bannerRegionBadge.textContent = `📍 Region Partition: ${regionFullName}`;
            if (bannerDatabaseCode) bannerDatabaseCode.textContent = dbHost;
            if (targetShardMetric) targetShardMetric.textContent = shardName;
            if (targetShardDbMetric) targetShardDbMetric.textContent = `PostgreSQL :${shardPort} (${currencyPrefix})`;
            if (metricShardTable) metricShardTable.textContent = `${shardName}.products`;
            if (tableSubtitleCode) tableSubtitleCode.textContent = `${dbHost}.products`;
            if (modalShardCode) modalShardCode.textContent = shardName;
            if (modalPriceLabel) modalPriceLabel.textContent = `Price (${currencyPrefix})`;
            if (editModalShardCode) editModalShardCode.textContent = shardName;
            if (editModalPriceLabel) editModalPriceLabel.textContent = `Price (${currencyPrefix})`;
            if (tablePriceColHeader) tablePriceColHeader.textContent = `Price (${currencyPrefix})`;
            if (footerShardCode) footerShardCode.textContent = shardName;
            if (footerDbIndicator) footerDbIndicator.textContent = `Database: ${dbHost}:${shardPort}`;

            // 3. Application State
            let loadedProducts = [];
            const inventoryTableBody = document.getElementById('inventoryTableBody');
            const activeProductsCountEl = document.getElementById('activeProductsCount');
            const totalRevenueMetricEl = document.getElementById('totalRevenueMetric');
            const totalUnitsCountEl = document.getElementById('totalUnitsCount');
            const productShowingTextEl = document.getElementById('productShowingText');
            const categoryFilter = document.getElementById('categoryFilter');

            // Toast helper
            function showToast(message, isSuccess = true) {
                const toast = document.getElementById('toastNotification');
                const content = document.getElementById('toastContent');
                if (!toast || !content) return;

                content.className = `flex items-center gap-3 px-4 py-3 rounded-xl shadow-lg border text-xs font-semibold ${
                    isSuccess 
                        ? 'bg-emerald-50 text-emerald-800 border-emerald-200' 
                        : 'bg-red-50 text-red-800 border-red-200'
                }`;
                content.innerHTML = `
                    <svg class="w-4 h-4 ${isSuccess ? 'text-emerald-500' : 'text-red-500'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${isSuccess 
                            ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>' 
                            : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>'}
                    </svg>
                    <span>${message}</span>
                `;

                toast.classList.remove('translate-y-[-100%]', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');

                setTimeout(() => {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('translate-y-[-100%]', 'opacity-0');
                }, 3500);
            }

            // 4. Data Rendering Functions (JavaScript Rendering)
            function renderMetrics(products) {
                const totalCount = products.length;
                const totalUnits = products.reduce((sum, p) => sum + (parseInt(p.stock_quantity ?? p.stock ?? 0, 10) || 0), 0);
                const totalRevenue = products.reduce((sum, p) => {
                    const price = parseFloat(p.price || 0);
                    const stock = parseInt(p.stock_quantity ?? p.stock ?? 0, 10) || 0;
                    return sum + (price * stock);
                }, 0);

                if (activeProductsCountEl) activeProductsCountEl.textContent = totalCount;
                if (totalUnitsCountEl) totalUnitsCountEl.textContent = totalUnits;
                if (totalRevenueMetricEl) {
                    totalRevenueMetricEl.textContent = `${currencySymbol} ${totalRevenue.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
                }
            }

            function renderInventoryTable(products) {
                if (!inventoryTableBody) return;

                if (products.length === 0) {
                    inventoryTableBody.innerHTML = `
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-500">
                                <div class="max-w-sm mx-auto flex flex-col items-center">
                                    <div class="w-12 h-12 rounded-full bg-orange-50 text-shopee flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-gray-800">No products found in this shard</p>
                                    <p class="text-xs text-gray-400 mt-1">No products match your filter or you haven't created any items yet.</p>
                                    <button onclick="document.getElementById('openModalBtn').click()" class="mt-4 px-4 py-2 bg-shopee text-white text-xs font-bold rounded-lg shadow-sm hover:bg-shopee-hover transition cursor-pointer">
                                        + Add Your First Product
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    if (productShowingTextEl) {
                        productShowingTextEl.innerHTML = `Showing 0 products on <strong>${shardName}</strong>`;
                    }
                    return;
                }

                // Generate table rows dynamically
                const rowsHtml = products.map((product, index) => {
                    const sku = product.id ? product.id.substring(0, 8).toUpperCase() : (product.sku || 'SKU-NEW');
                    const title = product.title || 'Untitled Product';
                    const description = product.description || 'No description available';
                    const category = product.category_slug || product.category || 'General';
                    const priceVal = parseFloat(product.price || 0).toFixed(2);
                    const stockVal = parseInt(product.stock_quantity ?? product.stock ?? 0, 10);

                    // Stock badge styling
                    let stockBadge = '';
                    if (stockVal > 10) {
                        stockBadge = `<span class="inline-flex items-center gap-1 font-semibold text-emerald-600"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>${stockVal} in stock</span>`;
                    } else if (stockVal > 0) {
                        stockBadge = `<span class="inline-flex items-center gap-1 font-semibold text-amber-600 text-center">${stockVal}</span>`;
                    } else {
                        stockBadge = `<span class="inline-flex items-center gap-1 font-semibold text-red-600"><span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>Out of stock</span>`;
                    }

                    return `
                        <tr class="hover:bg-gray-50/80 transition" data-category="${String(category).toLowerCase()}">
                            <td class="py-3.5 px-4 font-mono font-bold text-gray-500">
                                <span class="bg-gray-100 px-2 py-0.5 rounded text-[11px]">${sku}</span>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-gray-900 line-clamp-1">${title}</div>
                                <div class="text-[11px] text-gray-400 line-clamp-1">${description}</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2.5 py-1 bg-orange-50 text-shopee border border-orange-100 rounded-md text-[11px] font-semibold capitalize">
                                    ${category}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-shopee">
                                ${currencySymbol} ${priceVal}
                            </td>
                            <td class="py-3.5 px-4">
                                ${stockBadge}
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-100 text-green-700 uppercase">
                                    Active
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <button type="button" data-index="${index}" class="edit-product-btn inline-block px-3 py-1.5 bg-gray-100 text-gray-700 text-[11px] font-semibold rounded hover:bg-gray-200 transition cursor-pointer">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    `;
                }).join('');

                inventoryTableBody.innerHTML = rowsHtml;

                // Bind click events to Edit buttons
                const editButtons = inventoryTableBody.querySelectorAll('.edit-product-btn');
                editButtons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const idx = parseInt(btn.getAttribute('data-index'), 10);
                        const product = products[idx];
                        openEditModal(product);
                    });
                });

                if (productShowingTextEl) {
                    productShowingTextEl.innerHTML = `Showing ${products.length} of ${loadedProducts.length} products on <strong>${shardName}</strong>`;
                }
            }

            // 5. Fetch Products from API (JavaScript Shard Query)
            async function fetchSellerProducts() {
                if (!inventoryTableBody) return;

                // Show skeleton loading state in table
                inventoryTableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-500">
                            <div class="inline-block animate-spin rounded-full h-7 w-7 border-4 border-shopee border-t-transparent mb-2"></div>
                            <p class="text-xs font-medium">Querying ${shardName} for products...</p>
                        </td>
                    </tr>
                `;

                try {
                    const response = await fetch(`/api/products/seller/${encodeURIComponent(clean_user_id)}?home_region=${encodeURIComponent(clean_home_region)}`, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`,
                            'X-Region': clean_home_region
                        }
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        const errorMsg = result.message || 'Failed to fetch inventory from shard';
                        throw new Error(errorMsg);
                    }

                    loadedProducts = Array.isArray(result.data) ? result.data : [];
                    
                    // Render data
                    renderMetrics(loadedProducts);
                    applyFilter();

                } catch (error) {
                    console.error('Error fetching seller products:', error);
                    inventoryTableBody.innerHTML = `
                        <tr>
                            <td colspan="7" class="py-12 text-center text-red-600 bg-red-50/50">
                                <p class="text-xs font-bold">Failed to load shard inventory</p>
                                <p class="text-[11px] text-red-500 mt-1">${error.message}</p>
                                <button id="retryFetchBtn" class="mt-3 px-3 py-1.5 bg-red-600 text-white rounded text-xs font-semibold hover:bg-red-700 transition cursor-pointer">
                                    Retry Connection
                                </button>
                            </td>
                        </tr>
                    `;
                    document.getElementById('retryFetchBtn')?.addEventListener('click', fetchSellerProducts);
                    showToast(error.message, false);
                }
            }

            // 6. Category Filter Handler
            function applyFilter() {
                const selected = categoryFilter ? categoryFilter.value.toLowerCase() : 'all';
                if (selected === 'all') {
                    renderInventoryTable(loadedProducts);
                } else {
                    const filtered = loadedProducts.filter(p => {
                        const cat = (p.category_slug || p.category || '').toLowerCase();
                        return cat.includes(selected) || selected.includes(cat);
                    });
                    renderInventoryTable(filtered);
                }
            }

            categoryFilter?.addEventListener('change', applyFilter);

            // Refresh button handler
            document.getElementById('refreshBtn')?.addEventListener('click', () => {
                fetchSellerProducts();
                showToast('Refreshing inventory from shard database...');
            });

            // 7. Add Product Modal Controls
            const modal = document.getElementById('productModal');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelModalBtn = document.getElementById('cancelModalBtn');
            const addProductForm = document.getElementById('addProductForm');
            const saveProductBtn = document.getElementById('saveProductBtn');

            function openModal() {
                if (modal) modal.classList.remove('hidden');
            }

            function closeModal() {
                if (modal) modal.classList.add('hidden');
                if (addProductForm) addProductForm.reset();
            }

            openModalBtn?.addEventListener('click', openModal);
            closeModalBtn?.addEventListener('click', closeModal);
            cancelModalBtn?.addEventListener('click', closeModal);

            modal?.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            // 8. Edit Product Modal Controls
            const editModal = document.getElementById('editProductModal');
            const closeEditModalBtn = document.getElementById('closeEditModalBtn');
            const cancelEditModalBtn = document.getElementById('cancelEditModalBtn');
            const editProductForm = document.getElementById('editProductForm');
            const editProdTitle = document.getElementById('editProdTitle');
            const editProdDesc = document.getElementById('editProdDesc');
            const editProdCategory = document.getElementById('editProdCategory');
            const editProdPrice = document.getElementById('editProdPrice');
            const editProdStock = document.getElementById('editProdStock');

            function openEditModal(product = null) {
                if (product) {
                    if (editProdTitle) editProdTitle.value = product.title || '';
                    if (editProdDesc) editProdDesc.value = product.description || '';
                    if (editProdCategory) editProdCategory.value = product.category_slug || product.category || 'electronics';
                    if (editProdPrice) editProdPrice.value = parseFloat(product.price || 0).toFixed(2);
                    if (editProdStock) editProdStock.value = parseInt(product.stock_quantity ?? product.stock ?? 0, 10);
                }
                if (editModal) editModal.classList.remove('hidden');
            }

            function closeEditModal() {
                if (editModal) editModal.classList.add('hidden');
                if (editProductForm) editProductForm.reset();
            }

            closeEditModalBtn?.addEventListener('click', closeEditModal);
            cancelEditModalBtn?.addEventListener('click', closeEditModal);

            editModal?.addEventListener('click', (e) => {
                if (e.target === editModal) closeEditModal();
            });

            editProductForm?.addEventListener('submit', async (e) => {
                e.preventDefault();

                const title = document.getElementById('editProdTitle').value.trim();
                const desc = document.getElementById('editProdDesc').value.trim();
                const category = document.getElementById('editProdCategory').value;
                const price = parseFloat(document.getElementById('editProdPrice').value);
                const stock = parseInt(document.getElementById('editProdStock').value, 10);
                
                
                if(updateProductBtn){
                    updateProductBtn.disabled = true;
                    updateProductBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Updating...</span>
                    `;
                }

                try {

                const response = await fetch(`/api/products/update/${encodeURIComponent(clean_user_id)}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`,
                        'X-Region': clean_home_region
                    },
                    body: JSON.stringify({
                        title: title,
                        description: desc,
                        category_slug: category,
                        price: price.toFixed(2),
                        stock_quantity: stock,
                        home_region: clean_home_region,
                        seller_id: clean_user_id
                    })
                });

                const result = await response.json();

                if (!response.ok) {
                    const errMsg = result.message || (result.errors ? Object.values(result.errors).flat().join(', ') : 'Failed to update product');
                    throw new Error(errMsg);
                    }   

                if (result.data){
                    console.log('Product updated successfully:', result.data);
                    closeEditModal();
                }
            

                } catch( err){
                    console.error('Update product error:', err);
                    showToast(err.message || 'Error updating product.', false);
                } finally {
                    if(updateProductBtn){
                        updateProductBtn.disabled = false;
                        updateProductBtn.innerHTML = `<span>Update Product</span>`;
                    }
                }

                
               
            });

            // 9. Handle Client-Side Product Creation via JS
            addProductForm?.addEventListener('submit', async (e) => {
                e.preventDefault();

                const title = document.getElementById('prodTitle').value.trim();
                const desc = document.getElementById('prodDesc').value.trim();
                const category = document.getElementById('prodCategory').value;
                const price = parseFloat(document.getElementById('prodPrice').value);
                const stock = parseInt(document.getElementById('prodStock').value, 10);

                if (!title || isNaN(price) || isNaN(stock)) {
                    showToast('Please fill all required fields properly.', false);
                    return;
                }

                // Disable submit button while saving
                if (saveProductBtn) {
                    saveProductBtn.disabled = true;
                    saveProductBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span>Saving...</span>
                    `;
                }

                try {
                    const response = await fetch('/api/products/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${token}`,
                            'X-Region': clean_home_region
                        },
                        body: JSON.stringify({
                            title: title,
                            description: desc,
                            category_slug: category,
                            price: price.toFixed(2),
                            stock_quantity: stock,
                            home_region: clean_home_region,
                            seller_id: clean_user_id
                        })
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        const errMsg = result.message || (result.errors ? Object.values(result.errors).flat().join(', ') : 'Failed to create product');
                        throw new Error(errMsg);
                    }

                    // Success!
                    closeModal();
                    showToast('Product successfully saved to ' + shardName + '!');

                    // Prepend newly created product to state and re-render
                    if (result.data) {
                        loadedProducts.unshift(result.data);
                        renderMetrics(loadedProducts);
                        applyFilter();
                    } else {
                        // Or re-fetch from shard
                        fetchSellerProducts();
                    }

                } catch (err) {
                    console.error('Add product error:', err);
                    showToast(err.message || 'Error saving product.', false);
                } finally {
                    if (saveProductBtn) {
                        saveProductBtn.disabled = false;
                        saveProductBtn.innerHTML = `<span>Save to Shard</span>`;
                    }
                }
            });

            // 10. Sign out handler
            document.getElementById('sellerSignOutBtn')?.addEventListener('click', (e) => {
                e.preventDefault();
                localStorage.removeItem('auth_token');
                localStorage.removeItem('id');
                localStorage.removeItem('user');
                localStorage.removeItem('home_region');
                window.location.href = '/';
            });

            // 11. Initial Data Load
            fetchSellerProducts();
        });
    </script>
</body>

</html>