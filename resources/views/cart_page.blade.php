<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f6f6f6]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopping Cart - ShopeeAsia</title>

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
                <span>🔒 Secure Shopping Cart</span>
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
                <h1 class="text-lg font-medium text-gray-800">Shopping Cart</h1>
            </div>

            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-orange-100 text-shopee flex items-center justify-center font-bold text-xs">
                    U
                </div>
                <span class="text-xs font-semibold text-gray-700 hidden sm:inline" id="emailAddress"></span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-5">

        <!-- Free Shipping Promo Banner -->
        <div class="bg-orange-50 border border-orange-200 text-shopee rounded-2xl p-4 flex items-center gap-3 text-xs">
            <span class="text-base">🚚</span>
            <span>Add RM 15.00 more to unlock <strong>Free Shipping</strong> on qualifying orders!</span>
        </div>

        <!-- Cart Table Header -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-4 hidden md:grid grid-cols-12 gap-4 text-xs font-semibold text-gray-500 uppercase tracking-wider items-center">
            <div class="col-span-6 flex items-center gap-3">
                <input type="checkbox" id="select-all-top" class="select-all accent-shopee w-4 h-4 rounded cursor-pointer">
                <span>Product</span>
            </div>
            <div class="col-span-2 text-center">Unit Price</div>
            <div class="col-span-2 text-center">Quantity</div>
            <div class="col-span-1 text-center">Total Price</div>
            <div class="col-span-1 text-right">Actions</div>
        </div>

        <!-- Shop Group Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs overflow-hidden" id="cart-container">
            
            <!-- Shop Header -->
            <div class="px-6 py-3 bg-gray-50/70 border-b border-gray-100 flex items-center gap-3 text-xs font-semibold text-gray-800">
                <input type="checkbox" class="shop-select accent-shopee w-4 h-4 rounded cursor-pointer" checked>
                <span class="px-1.5 py-0.5 rounded bg-shopee text-white text-[10px] font-bold">Mall</span>
                <span>ErgoKeys Official Store</span>
                <span class="text-gray-400 font-normal">| Chat Now</span>
            </div>

            @forelse ($cart_items as $item)
                <!-- Dynamic Product Row -->
                <div class="cart-item grid grid-cols-12 gap-4 p-6 items-center border-b border-gray-100 text-xs" 
                     data-price="{{ $item->price }}" 
                     data-id="{{ $item->id }}">
                    <div class="col-span-12 md:col-span-6 flex items-start gap-4">
                        <input type="checkbox" class="item-select accent-shopee w-4 h-4 mt-2 rounded cursor-pointer" checked>
                        <div class="w-16 h-16 rounded-lg bg-gray-100 border border-gray-200 flex-shrink-0 flex items-center justify-center text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <p class="font-medium text-gray-900 leading-snug line-clamp-2">
                                {{ $item->product->title ?? 'Product unavailable' }}
                            </p>
                            <p class="text-gray-400 text-[11px]">
                                Category: {{ $item->product->category_slug ?? 'General' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-span-4 md:col-span-2 text-left md:text-center text-gray-700">
                        <span class="md:hidden text-gray-400">Unit: </span>RM <span class="unit-price">{{ number_format($item->price, 2) }}</span>
                    </div>

                    <div class="col-span-4 md:col-span-2 flex justify-center items-center">
                        <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                            <button type="button" class="btn-qty-minus px-2.5 py-1 text-gray-600 hover:bg-gray-100">-</button>
                            <input type="text" value="{{ $item->quantity }}" class="qty-input w-10 py-1 text-center text-xs font-semibold focus:outline-none border-x border-gray-200" readonly>
                            <button type="button" class="btn-qty-plus px-2.5 py-1 text-gray-600 hover:bg-gray-100">+</button>
                        </div>
                    </div>

                    <div class="col-span-4 md:col-span-1 text-center font-bold text-shopee">
                        RM <span class="row-total">{{ number_format($item->price * $item->quantity, 2) }}</span>
                    </div>

                    <div class="col-span-12 md:col-span-1 text-right">
                        <button type="button" class="btn-delete text-gray-400 hover:text-shopee text-xs transition">Delete</button>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500 text-xs">
                    Your cart is empty.
                </div>
            @endforelse

        </div>

        <!-- Empty Cart Notice (hidden by default) -->
        <div id="empty-cart-view" class="hidden bg-white rounded-2xl border border-gray-200 p-12 text-center space-y-4">
            <div class="text-4xl">🛒</div>
            <p class="text-sm font-medium text-gray-700">Your shopping cart is empty</p>
            <a href="{{ url('/home') }}" class="inline-block px-6 py-2 bg-shopee hover:bg-shopee-hover text-white text-xs font-semibold rounded-xl">Go Shopping Now</a>
        </div>

        <!-- Sticky Bottom Bar -->
        <div class="sticky bottom-0 bg-white rounded-2xl border border-gray-200 shadow-md p-4 flex flex-col sm:flex-row items-center justify-between gap-4 z-30">
            <div class="flex items-center gap-4 text-xs">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" id="select-all-bottom" class="select-all accent-shopee w-4 h-4 rounded" checked>
                    <span class="font-medium text-gray-700">Select All (<span id="total-selected-count">2</span>)</span>
                </label>
                <button type="button" id="btn-delete-selected" class="text-gray-400 hover:text-shopee transition">Delete Selected</button>
            </div>

            <div class="flex items-center justify-between w-full sm:w-auto sm:justify-end gap-6">
                <div class="text-right">
                    <div class="text-xs text-gray-500">
                        Total (<span id="checkout-item-count">2</span> item<span id="plural-s">s</span>):
                        <span class="text-lg font-bold text-shopee ml-1">RM <span id="cart-grand-total">294.00</span></span>
                    </div>
                    <div class="text-[10px] text-emerald-600 font-medium">Saved RM 10.00 with vouchers</div>
                </div>
                
                <a href="{{ url('/checkout') }}" id="checkout-button"
                    class="py-3 px-8 bg-shopee hover:bg-shopee-hover text-white font-bold text-xs rounded-xl shadow-xs transition text-center inline-block">
                    Check Out
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

    <!-- Client-Side State & Calculation Script -->
    <script>
        const emailAddress = document.getElementById("emailAddress");
        const localStorageEmail = localStorage.getItem("user_email");
        emailAddress.textContent = localStorageEmail ? localStorageEmail : "buyer@shopee.my";

        const itemCheckboxes = () => document.querySelectorAll('.item-select');
        const selectAllBoxes = document.querySelectorAll('.select-all');
        const grandTotalEl = document.getElementById('cart-grand-total');
        const selectedCountEl = document.getElementById('total-selected-count');
        const checkoutCountEl = document.getElementById('checkout-item-count');

        function recalculate() {
            let grandTotal = 0;
            let checkedItems = 0;

            document.querySelectorAll('.cart-item').forEach(item => {
                const isChecked = item.querySelector('.item-select').checked;
                const price = parseFloat(item.dataset.price);
                const qty = parseInt(item.querySelector('.qty-input').value);
                const rowTotal = price * qty;

                item.querySelector('.row-total').textContent = rowTotal.toFixed(2);

                if (isChecked) {
                    grandTotal += rowTotal;
                    checkedItems += qty;
                }
            });

            grandTotalEl.textContent = grandTotal.toFixed(2);
            selectedCountEl.textContent = checkedItems;
            checkoutCountEl.textContent = checkedItems;

            const allSelected = Array.from(itemCheckboxes()).every(cb => cb.checked);
            selectAllBoxes.forEach(box => box.checked = allSelected && itemCheckboxes().length > 0);

            // Persist into localStorage for use by Checkout
            localStorage.setItem("cart_total", grandTotal.toFixed(2));
            localStorage.setItem("cart_count", checkedItems);
        }

        // Checkbox events
        selectAllBoxes.forEach(box => {
            box.addEventListener('change', (e) => {
                itemCheckboxes().forEach(cb => cb.checked = e.target.checked);
                document.querySelector('.shop-select').checked = e.target.checked;
                selectAllBoxes.forEach(b => b.checked = e.target.checked);
                recalculate();
            });
        });

        document.addEventListener('change', (e) => {
            if (e.target.classList.contains('item-select')) {
                recalculate();
            }
        });

        // Quantity controls
        document.querySelectorAll('.cart-item').forEach(item => {
            const minusBtn = item.querySelector('.btn-qty-minus');
            const plusBtn = item.querySelector('.btn-qty-plus');
            const qtyInput = item.querySelector('.qty-input');

            minusBtn.addEventListener('click', () => {
                let qty = parseInt(qtyInput.value);
                if (qty > 1) {
                    qtyInput.value = --qty;
                    recalculate();
                }
            });

            plusBtn.addEventListener('click', () => {
                let qty = parseInt(qtyInput.value);
                qtyInput.value = ++qty;
                recalculate();
            });

            item.querySelector('.btn-delete').addEventListener('click', () => {
                item.remove();
                checkEmptyCart();
                recalculate();
            });
        });

        // Bulk delete
        document.getElementById('btn-delete-selected').addEventListener('click', () => {
            document.querySelectorAll('.cart-item').forEach(item => {
                if (item.querySelector('.item-select').checked) {
                    item.remove();
                }
            });
            checkEmptyCart();
            recalculate();
        });

        function checkEmptyCart() {
            if (document.querySelectorAll('.cart-item').length === 0) {
                document.getElementById('cart-container').classList.add('hidden');
                document.getElementById('empty-cart-view').classList.remove('hidden');
            }
        }

        recalculate();
    </script>
</body>

</html>