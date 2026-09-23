<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f6f6f6]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - ShopeeAsia</title>

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
                <span>🔒 Secure Checkout Guaranteed</span>
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
                <h1 class="text-lg font-medium text-gray-800">Checkout</h1>
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

        @php
            $qty = (int) ($quantity ?? request('query', request('quantity', 1)));
            if ($qty < 1) $qty = 1;
            $unitPrice = $regionCode == 'SG' ? $product->price * 0.32 : $product->price;
            $totalPrice = $unitPrice * $qty;
        @endphp

        <!-- Delivery Address Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs overflow-hidden">
            <div class="h-1 bg-[repeating-linear-gradient(45deg,#ee4d2d,#ee4d2d_30px,#fff_30px,#fff_40px,#4080ff_40px,#4080ff_70px,#fff_70px,#fff_80px)]"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2 text-shopee font-semibold text-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span>Delivery Address</span>
                    </div>
                    <button type="button" class="text-xs text-shopee hover:underline font-medium">Change</button>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-2 text-xs text-gray-700">
                    <span class="font-bold text-gray-900">Ahmad Razali (+60 12-345 6789)</span>
                    <span class="hidden sm:inline text-gray-300">|</span>
                    <span class="text-gray-600">No. 18, Jalan SS 15/4, Subang Jaya, 47500 Selangor, Malaysia</span>
                    <span class="inline-flex self-start sm:self-auto border border-shopee text-shopee text-[10px] px-1.5 py-0.5 rounded font-medium">Default</span>
                </div>
            </div>
        </div>

        <!-- Order Items Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs overflow-hidden">
            <!-- Table Header -->
            <div class="grid grid-cols-12 gap-4 px-6 py-4 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                <span class="col-span-12 md:col-span-6">Products Ordered</span>
                <span class="hidden md:block md:col-span-2 text-center">Unit Price</span>
                <span class="hidden md:block md:col-span-2 text-center">Amount</span>
                <span class="hidden md:block md:col-span-2 text-right">Item Subtotal</span>
            </div>

            <!-- Shop Info -->
            <div class="px-6 py-3 bg-gray-50/70 border-b border-gray-100 flex items-center gap-2 text-xs font-semibold text-gray-800">
                <span class="px-1.5 py-0.5 rounded bg-shopee text-white text-[10px] font-bold">Mall</span>
                <span>{{ $product->seller?->email ?? 'ErgoKeys Official Store' }}</span>
                <span class="text-gray-400 font-normal">| Chat Now</span>
            </div>

            <!-- Product Row 1 -->
            <div class="grid grid-cols-12 gap-4 p-6 items-center border-b border-gray-100 text-xs">
                <div class="col-span-12 md:col-span-6 flex gap-4">
                    <div class="w-16 h-16 rounded-lg bg-gray-100 border border-gray-200 flex-shrink-0 flex items-center justify-center text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" />
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <p class="font-medium text-gray-900 leading-snug line-clamp-2">
                            {{ $product->title }}
                        </p>
                        <p class="text-gray-400 text-[11px]">Category: {{ $product->category_slug }}</p>
                    </div>
                </div>
                <div class="col-span-4 md:col-span-2 text-left md:text-center text-gray-700">
                    <span class="md:hidden text-gray-400">Unit: </span>
                    @if ($regionCode == "MY")
                        RM {{ number_format($product->price, 2) }}
                    @elseif ($regionCode == "SG")
                        SGD {{ number_format($product->price * 0.32, 2) }}
                    @endif
                </div>
                <div class="col-span-4 md:col-span-2 text-center text-gray-700">
                    <span class="md:hidden text-gray-400">Qty: </span>{{ $quantity }}
                </div>
                <div class="col-span-4 md:col-span-2 text-right font-bold text-gray-900">

                    @if ($regionCode == "MY")
                        RM {{ $product->price }}
                    @elseif ($regionCode == "SG")
                        SGD {{ $product->price * 0.32 }}
                    @endif
                </div>
            </div>

            <!-- Shipping Option Sub-row -->
            <div class="bg-orange-50/30 p-6 flex flex-col md:flex-row md:items-center justify-between gap-4 text-xs border-b border-gray-100">
                <div class="flex items-center gap-2 text-gray-700">
                    <span class="text-emerald-700 font-medium">🚚 Standard Delivery</span>
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-500">Guaranteed arrival in 2 - 3 days</span>
                </div>
                <div class="flex items-center justify-between md:justify-end gap-6">
                    <button type="button" class="text-shopee hover:underline font-medium">Change Option</button>
                    <span class="font-semibold text-emerald-600">FREE</span>
                </div>
            </div>

            <!-- Order Total for shop -->
            <div class="px-6 py-4 flex justify-between md:justify-end items-center gap-4 text-xs bg-gray-50/40">
                <span class="text-gray-500">Order Total ({{ $quantity }} Item)</span>
                <span class="text-base font-bold text-shopee">
                    
                    @if ($regionCode == "MY")
                        RM {{ $product->price }}
                    @elseif ($regionCode == "SG")
                        SGD {{ $product->price * 0.32 }}
                    @endif

                </span>
            </div>
        </div>

        <!-- Voucher and Discounts -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-xs">
            <div class="flex items-center gap-3">
                <div class="w-7 h-7 rounded bg-orange-100 text-shopee flex items-center justify-center font-bold">
                    🎟️
                </div>
                <div>
                    <p class="font-semibold text-gray-900">Platform Voucher Applied</p>
                    <p class="text-gray-400 text-[11px]">Free Shipping + RM 10.00 Off Electronics</p>
                </div>
            </div>
            <button type="button" class="text-shopee font-semibold hover:underline self-end sm:self-auto">
                Select Other Voucher
            </button>
        </div>

        <!-- Payment Method & Checkout Summary Section -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-6 space-y-6">
            <div class="space-y-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Payment Method</h3>

                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                    <label class="border-2 border-shopee bg-orange-50/20 rounded-xl p-3 flex items-center justify-between cursor-pointer">
                        <span class="text-xs font-semibold text-gray-800">ShopeePay</span>
                        <input type="radio" name="payment_method" value="shopeepay" checked class="accent-shopee">
                    </label>

                    <label class="border border-gray-200 hover:border-gray-300 rounded-xl p-3 flex items-center justify-between cursor-pointer">
                        <span class="text-xs font-semibold text-gray-800">Online Banking (FPX)</span>
                        <input type="radio" name="payment_method" value="fpx" class="accent-shopee">
                    </label>

                    <label class="border border-gray-200 hover:border-gray-300 rounded-xl p-3 flex items-center justify-between cursor-pointer">
                        <span class="text-xs font-semibold text-gray-800">Credit / Debit Card</span>
                        <input type="radio" name="payment_method" value="card" class="accent-shopee">
                    </label>

                    <label class="border border-gray-200 hover:border-gray-300 rounded-xl p-3 flex items-center justify-between cursor-pointer">
                        <span class="text-xs font-semibold text-gray-800">Cash on Delivery</span>
                        <input type="radio" name="payment_method" value="cod" class="accent-shopee">
                    </label>
                </div>
            </div>

            <hr class="border-gray-100" />

            <!-- Price Breakdown Calculation -->
            <div class="flex flex-col items-end space-y-2 text-xs text-gray-600">
                <div class="flex justify-between w-full sm:w-72">
                    <span>Merchandise Subtotal:</span>
                    <span class="text-gray-900 font-medium">
                        
                    @if ($regionCode == "MY")
                        RM {{ $product->price }}
                    @elseif ($regionCode == "SG")
                        SGD {{ $product->price * 0.32 }}
                    @endif
                    </span>
                </div>
                <div class="flex justify-between w-full sm:w-72">
                    <span>Shipping Total:</span>
                    <span class="text-gray-900 font-medium">None</span>
                </div>
                <div class="flex justify-between w-full sm:w-72">
                    <span>Shipping Discount Subtotal:</span>
                    <span class="text-emerald-600 font-medium">None</span>
                </div>
                <div class="flex justify-between w-full sm:w-72">
                    <span>Voucher Discount:</span>
                    <span class="text-emerald-600 font-medium">None</span>
                </div>
                <div class="flex justify-between w-full sm:w-72 pt-3 border-t border-gray-100 items-baseline">
                    <span class="text-sm font-semibold text-gray-900">Total Payment:</span>
                    <span class="text-2xl font-extrabold text-shopee">
                        
                    @if ($regionCode == "MY")
                        RM {{ $product->price }}
                    @elseif ($regionCode == "SG")
                        SGD {{ $product->price * 0.32 }}
                    @endif
                    </span>
                </div>
            </div>

            <!-- Place Order Action -->
            <div class="flex flex-col sm:flex-row items-center justify-between pt-4 border-t border-gray-100 gap-4">
                <p class="text-[11px] text-gray-400">
                    By placing your order, you agree to our <a href="#" class="text-gray-600 underline">Terms of Service</a> and return policies.
                </p>
                <button type="button" id="place-order-button"
                    class="w-full sm:w-60 py-3.5 px-6 bg-shopee hover:bg-shopee-hover text-white font-bold text-sm rounded-xl shadow-xs transition text-center">
                    Place Order
                </button>
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






    <!----------------------------- script for javascript ---------------------------->
    <script>
        const emailAddress = document.getElementById("emailAddress");
        const localStorageEmail = localStorage.getItem("user_email");

        emailAddress.textContent = localStorageEmail ? localStorageEmail : "buyer@shopee.my";

        const placeOrderBtn = document.getElementById("place-order-button");


        placeOrderBtn.addEventListener("click", async () => {
            

            placeOrderBtn.disabled = true;
            placeOrderBtn.innerText = "Processing Payment...";


            try {
                // gather payload to be sent to the api created in api.php
                // use compact view to get the $product and $regionCode values to be sent as payload
                const payload = {
                    product_id : "{{ $product->id }}",
                    amount: {{ $regionCode === 'SG' ? $product->price * 0.32 : $product->price }},
                    currency : "{{ $regionCode === 'SG' ? 'SGD' : 'MYR' }}",
                    email : localStorage.getItem("user_email") || 'buyer@shoppee.com'

                };

                // fetch the api to perform a transaction
                const response = await fetch("/api/payments/create-invoice" , {
                    method : "POST",
                    headers : {
                        "Content-Type" : "application/json",
                        "Accept" : "application/json",
                        "X-CSRF-TOKEN" : "{{ csrf_token() }}" // csrf token for verifying that the request is from our server
                    },
                    body : JSON.stringify(payload)
                });


                // get the response from the api
                const data = await response.json();

                // if response was successful , redirect user to invoice url
                if (response.ok && data.invoice_url) {
                    window.location.href = data.invoice_url;
                } else {

                    // if fails , return error message
                    alert(data.message || "Payment initiation failed , please try again")
                    placeOrderBtn.disabled = false;
                    placeOrderBtn.innerText = "Place Order";
                }
                
            } catch ( err) {
                console.log(err);
                alert("Something went wrong!");
                placeOrderBtn.disabled=false;
                placeOrderBtn.innerText =" Place Order";
            }
        });
    </script>
</body>

</html>