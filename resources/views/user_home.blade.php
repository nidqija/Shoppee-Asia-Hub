<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f8f9fa]">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home - ShopeeAsia</title>

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
        
        <!-- Navigation Header -->
        <header class="w-full bg-white border-b border-gray-200 sticky top-0 z-50 shadow-xs">
            <div class="max-w-7xl mx-auto flex items-center justify-between py-3.5 px-4 sm:px-6 lg:px-8">
                
                <!-- Brand / Logo -->
                <div class="flex items-center gap-3">
                    <a href="#" class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-lg bg-shopee text-white flex items-center justify-center font-bold text-lg shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-gray-900">ShopeeAsia</span>
                    </a>
                    <span id="regionBadge" class="hidden text-xs font-semibold px-2 py-0.5 rounded-full bg-orange-100 text-shopee uppercase">
                        --
                    </span>
                </div>

                <!-- Center Search Input -->
                <div class="hidden md:flex flex-1 max-w-md mx-8">
                    <div class="relative w-full">
                        <input type="text" id="searchInput" placeholder="Search products across regional shards..." 
                            class="w-full pl-9 pr-4 py-1.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-shopee focus:bg-white transition" />
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- User Profile & Action Strip -->
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p id="userEmail" class="text-xs font-semibold text-gray-900 leading-tight">Loading...</p>
                        <p id="userRole" class="text-[11px] text-gray-500 capitalize leading-tight">Member</p>
                    </div>

                    <!-- Logout Button -->
                    <button id="logoutBtn" type="button" class="text-xs font-medium text-gray-600 hover:text-shopee border border-gray-200 hover:border-shopee px-3 py-1.5 rounded-md transition cursor-pointer">
                        Logout
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
            
            <!-- Welcome Hero Banner -->
            <div class="bg-gradient-to-r from-orange-500 via-shopee to-red-600 rounded-2xl p-6 sm:p-8 text-white shadow-lg relative overflow-hidden">
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur mb-3">
                        ⚡ Connected to <span id="heroRegion" class="uppercase">--</span> Region!
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        Welcome back, <span id="heroEmail" class="underline decoration-white/40">Shopper</span>!
                    </h1>
                    <p class="mt-2 text-sm text-white/90 leading-relaxed">
                        Explore exclusive offers, check shard stock, and enjoy express cross-border logistics.
                    </p>
                </div>
                
                <!-- Decorative Graphic -->
                <div class="absolute -right-8 -bottom-10 opacity-15 hidden sm:block">
                    <svg class="w-64 h-64 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
            </div>

            <!-- Regional Filters & Catalog Heading -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-200 pb-4">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Featured Products</h2>
                    <p class="text-xs text-gray-500">Live products queried directly from the regional database shard</p>
                </div>

                <!-- Shard Switcher Tabs -->
                <div class="relative inline-block">
                    <select 
                        id="categoryDropdown"
                        onchange="(() => {
                            const selectedCategory = this.value;
                            console.log('Selected category:', selectedCategory);
                            // Example: filter products or trigger a custom event
                            const event = new CustomEvent('categoryChanged', { detail: selectedCategory });
                            window.dispatchEvent(event);
                        })()"
                        class="appearance-none bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-semibold py-2 pl-3 pr-8 rounded-lg border border-transparent focus:border-shopee focus:bg-white focus:outline-none transition cursor-pointer"
                    >
                        <option value="all">All Categories</option>
                        <option value="electronics">Electronics</option>
                        <option value="fashion">Fashion</option>
                        <option value="home-living">Home & Living</option>
                        <option value="beauty">Health & Beauty</option>
                    </select>
                    
                    <!-- Custom Dropdown Arrow Icon -->
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
</div>
            </div>

            <!-- Status & Alert Messages -->
            <div id="statusAlert" class="hidden p-3.5 rounded-lg text-xs font-medium"></div>

            <!-- Products Grid -->
            <div id="productsContainer" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <!-- Skeleton Loading Placeholders -->
                <div class="bg-white rounded-xl border border-gray-200 p-4 animate-pulse space-y-3">
                    <div class="h-32 bg-gray-200 rounded-lg"></div>
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 animate-pulse space-y-3">
                    <div class="h-32 bg-gray-200 rounded-lg"></div>
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4 animate-pulse space-y-3">
                    <div class="h-32 bg-gray-200 rounded-lg"></div>
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                </div>
            </div>

        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; {{ date('Y') }} ShopeeAsia Platform. Central Authentication & Regional Sharding Active.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:underline">Privacy Policy</a>
                    <a href="#" class="hover:underline">Terms of Service</a>
                    <a href="#" class="hover:underline">Help Centre</a>
                </div>
            </div>
        </footer>

        <!-- Inline Anonymous Execution Script -->
        <script>
            (() => {
                // 1. Authenticate Client Session
                const token = localStorage.getItem('auth_token');
                const rawUser = localStorage.getItem('user');

                // if there is no token being retrieved from localStorage, redirect to login page
                // to protect the user from accessing the home page without authentication
                if (!token || !rawUser) {
                    console.warn('No valid authentication found. Redirecting to login.');
                    window.location.href = '/';
                    return;
                }

                let user = {};
                try {
                    user = JSON.parse(rawUser);
                } catch {
                    localStorage.clear();
                    window.location.href = '/';
                    return;
                }

                // 2. Populate Header & Banner Profile Data
                const userEmailEl = document.getElementById('userEmail');
                const userRoleEl = document.getElementById('userRole');
                const regionBadgeEl = document.getElementById('regionBadge');
                const heroEmailEl = document.getElementById('heroEmail');
                const heroRegionEl = document.getElementById('heroRegion');
                const statusAlert = document.getElementById('statusAlert');
                const container = document.getElementById('productsContainer');

                if (userEmailEl) userEmailEl.textContent = user.email || 'User';
                if (userRoleEl) userRoleEl.textContent = `${user.role || 'Buyer'} • ${user.phone_number || ''}`;
                if (heroEmailEl) heroEmailEl.textContent = (user.email || 'Shopper').split('@')[0];
                
                const userRegion = (user.home_region || 'MY').toUpperCase();
                if (regionBadgeEl) {
                    regionBadgeEl.textContent = `${userRegion}`;
                    regionBadgeEl.classList.remove('hidden');
                }
                if (heroRegionEl) heroRegionEl.textContent = userRegion;

                // 3. Logout Handler (Anonymous Event Listener)
                document.getElementById('logoutBtn')?.addEventListener('click', () => {
                    localStorage.removeItem('auth_token');
                    localStorage.removeItem('user');
                    window.location.href = '/';
                });

                // 4. Products Loader Handler (Anonymous Execution Block)
                const loadProducts = async (endpoint, regionHeader = null) => {
                    container.innerHTML = `
                        <div class="col-span-full py-12 text-center">
                            <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-shopee border-t-transparent"></div>
                            <p class="mt-2 text-xs text-gray-500">Querying database shard...</p>
                        </div>
                    `;

                    statusAlert.classList.add('hidden');

                    const headers = {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`
                    };

                    if (regionHeader) {
                        headers['X-Region'] = regionHeader.toLowerCase();
                    }

                    try {
                        const response = await fetch(endpoint, {
                            method: 'GET',
                            headers: headers
                        });

                        const res = await response.json();

                        if (!response.ok) {
                            throw new Error(res.message || 'Failed to fetch catalog from shard');
                        }

                        const products = res.data || [];

                        if (products.length === 0) {
                            container.innerHTML = `
                                <div class="col-span-full py-12 text-center bg-white rounded-xl border border-gray-200">
                                    <p class="text-sm font-semibold text-gray-700">No products available</p>
                                    <p class="text-xs text-gray-400 mt-1">This regional shard currently has no listed inventory.</p>
                                </div>
                            `;
                            return;
                        }

                        container.innerHTML = products.map(item => `
                         <a href="/product-page-id/${item.id}" class="group">
                            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col justify-between group">
                                <div class="h-36 bg-gray-100 flex items-center justify-center relative overflow-hidden">
                                    <span class="text-3xl text-gray-300 group-hover:scale-110 transition duration-300">📦</span>
                                    <span class="absolute top-2 right-2 px-1.5 py-0.5 text-[10px] font-bold rounded bg-gray-900/70 text-white uppercase">
                                        ${item.region_code || userRegion}
                                    </span>
                                </div>
                                <div class="p-3.5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">${item.category_slug || 'General'}</p>
                                        <h3 class="text-sm font-bold text-gray-900 line-clamp-1 leading-snug">${item.title}</h3>
                                        <p class="text-xs text-gray-500 mt-1 line-clamp-2 leading-relaxed">${item.description || 'No description provided.'}</p>
                                    </div>
                                    <div class="mt-4 pt-2 border-t border-gray-100 flex items-center justify-between">
                                        <span class="text-sm font-extrabold text-shopee">
                                            ${(item.region_code || userRegion) === 'SG' ? 'SGD' : 'RM'} ${parseFloat(item.price || 0).toFixed(2)}
                                        </span>
                                        <button class="bg-shopee/10 hover:bg-shopee text-shopee hover:text-white p-1.5 rounded-lg text-xs transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </a>
                        `).join('');

                    } catch (err) {
                        console.error('Fetch error:', err);
                        container.innerHTML = '';
                        statusAlert.textContent = err.message || 'Error communicating with the shard database.';
                        statusAlert.className = 'p-3.5 rounded-lg text-xs font-medium bg-red-50 text-red-700 border border-red-200';
                        statusAlert.classList.remove('hidden');
                    }
                };

               

                // 6. Initial Load based on User's Home Region
                if (userRegion === 'SG') {
                    loadProducts('/api/products', 'sg');
                } else {
                    loadProducts('/api/products', 'my');
                }
            })();
        </script>
    </body>
</html>