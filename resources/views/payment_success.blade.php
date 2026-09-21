<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f6f6f6]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Successful - ShopeeAsia</title>

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
    <style>
        @keyframes scaleUp {
            0% { transform: scale(0.6); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes checkmark {
            0% { stroke-dashoffset: 50; }
            100% { stroke-dashoffset: 0; }
        }
        .animate-scale-up {
            animation: scaleUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .checkmark-icon {
            stroke-dasharray: 50;
            stroke-dashoffset: 0;
            animation: checkmark 0.6s ease-in-out forwards;
        }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .print-clean { border: none !important; box-shadow: none !important; }
        }
    </style>
</head>

<body class="min-h-full font-sans antialiased text-gray-800 flex flex-col justify-between">

    <!-- Top Utility Bar -->
    <div class="bg-shopee text-white text-xs py-1.5 px-4 no-print">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4 text-[11px] opacity-90">
                <span>🔒 Secure Transaction Completed</span>
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
    <header class="w-full bg-white border-b border-gray-200 sticky top-0 z-40 shadow-xs no-print">
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
                <h1 class="text-lg font-medium text-gray-800">Order Confirmation</h1>
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
    <main class="flex-grow max-w-4xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">

        <!-- Success Banner Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs p-8 text-center animate-scale-up print-clean">
            <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-5 ring-8 ring-emerald-50">
                <svg class="w-10 h-10 checkmark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Payment Verified & Confirmed
            </span>

            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Payment Successful!</h2>
            <p class="text-sm text-gray-500 mt-2 max-w-lg mx-auto">
                Thank you for your order! Your payment has been securely processed via Xendit. A receipt and confirmation have been dispatched to your email.
            </p>

            <!-- Order Reference Pill -->
            <div class="mt-6 inline-flex flex-wrap items-center justify-center gap-2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-xs text-gray-600">
                <span class="font-medium text-gray-400">Order Reference:</span>
                <span class="font-mono font-bold text-gray-900" id="orderReference">ORD-{{ strtoupper(substr(md5(time()), 0, 12)) }}</span>
                <button type="button" id="copyOrderRefBtn" class="text-shopee hover:underline font-semibold ml-1 cursor-pointer no-print" onclick="copyOrderRef()">
                    Copy
                </button>
            </div>
        </div>

        <!-- Order & Shipment Summary Card -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-xs overflow-hidden print-clean">
            <!-- Decorative colored border bar matching checkout -->
            <div class="h-1 bg-[repeating-linear-gradient(45deg,#ee4d2d,#ee4d2d_30px,#fff_30px,#fff_40px,#4080ff_40px,#4080ff_70px,#fff_70px,#fff_80px)]"></div>
            
            <div class="p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="font-bold text-gray-900 text-base">Transaction Details</h3>
                    <span class="text-xs text-gray-500 font-medium" id="transactionDate"></span>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
                    <!-- Delivery Info -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-gray-400 font-semibold uppercase tracking-wider text-[11px]">
                            <svg class="w-4 h-4 text-shopee" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            Delivery Address
                        </div>
                        <p class="font-bold text-gray-900 text-sm" id="customerName">Ahmad Razali (+60 12-345 6789)</p>
                        <p class="text-gray-600 leading-relaxed">No. 18, Jalan SS 15/4, Subang Jaya, 47500 Selangor, Malaysia</p>
                    </div>

                    <!-- Payment & Regional Routing Info -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-gray-400 font-semibold uppercase tracking-wider text-[11px]">
                            <svg class="w-4 h-4 text-shopee" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Payment Method
                        </div>
                        <p class="font-bold text-gray-900 text-sm flex items-center gap-2">
                            <span>Xendit Online Gateway</span>
                            <span class="text-[10px] font-semibold bg-blue-50 text-blue-600 border border-blue-200 px-2 py-0.5 rounded-full">Instant</span>
                        </p>
                        <p class="text-gray-600">Regional Shard: <span class="font-semibold text-gray-800" id="shardLabel">Malaysia Cluster (shard_my)</span></p>
                    </div>
                </div>

                <!-- Fulfillment Timeline / Status -->
                <div class="bg-[#fafafa] rounded-xl p-4 border border-gray-200">
                    <div class="flex items-center justify-between text-xs mb-3">
                        <span class="font-semibold text-gray-700">Fulfillment Status</span>
                        <span class="font-bold text-shopee">Preparing to Ship</span>
                    </div>
                    <!-- Step Progress Bar -->
                    <div class="grid grid-cols-3 gap-2 text-center text-[11px]">
                        <div class="space-y-1">
                            <div class="h-1.5 bg-emerald-500 rounded-full"></div>
                            <span class="font-medium text-emerald-700">Payment Paid</span>
                        </div>
                        <div class="space-y-1">
                            <div class="h-1.5 bg-shopee rounded-full"></div>
                            <span class="font-semibold text-shopee">Seller Processing</span>
                        </div>
                        <div class="space-y-1">
                            <div class="h-1.5 bg-gray-200 rounded-full"></div>
                            <span class="text-gray-400">Out for Delivery</span>
                        </div>
                    </div>
                </div>

                <!-- Buyer Protection Guarantee -->
                <div class="bg-shopee-light border border-orange-200 rounded-xl p-4 flex items-start sm:items-center gap-3 text-xs text-gray-700">
                    <div class="w-8 h-8 rounded-lg bg-orange-100 text-shopee flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-gray-900">Shopee Guarantee Covered:</span>
                        <span class="text-gray-600 ml-1">Payment is safely held until you confirm receipt of your item in pristine condition.</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 no-print">
            <button type="button" onclick="window.print()" class="w-full sm:w-auto px-6 py-3 bg-white hover:bg-gray-50 border border-gray-300 text-gray-700 font-semibold text-xs rounded-xl shadow-xs transition flex items-center justify-center gap-2 cursor-pointer">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Receipt
            </button>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ url('/seller-home') }}" class="w-full sm:w-auto px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs rounded-xl transition text-center">
                    Seller Portal
                </a>
                <a href="{{ url('/home') }}" class="w-full sm:w-auto px-8 py-3 bg-shopee hover:bg-shopee-hover text-white font-bold text-xs rounded-xl shadow-xs transition text-center flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Continue Shopping
                </a>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 text-center text-xs text-gray-500 mt-12 no-print">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p>&copy; {{ date('Y') }} ShopeeAsia Marketplace. Genuine regional inventory guaranteed.</p>
            <div class="flex items-center gap-4 text-gray-400">
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Terms of Service</a>
                <a href="#" class="hover:underline">Help Centre</a>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Retrieve User Info from LocalStorage
            const storedEmail = localStorage.getItem("user_email") || "buyer@shoppee.com";
            const storedRegion = localStorage.getItem("user_region") || "MY";
            
            const emailBadge = document.getElementById("userEmailBadge");
            if (emailBadge) {
                emailBadge.textContent = storedEmail;
            }

            const shardLabel = document.getElementById("shardLabel");
            if (shardLabel) {
                if (storedRegion.toUpperCase() === "SG") {
                    shardLabel.textContent = "Singapore Cluster (shard_sg)";
                } else {
                    shardLabel.textContent = "Malaysia Cluster (shard_my)";
                }
            }

            // Set Formatted Current Date & Time
            const dateElem = document.getElementById("transactionDate");
            if (dateElem) {
                const now = new Date();
                dateElem.textContent = now.toLocaleDateString('en-GB', { 
                    day: 'numeric', 
                    month: 'short', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            // Check URL parameters if Xendit or backend returned invoice IDs
            const urlParams = new URLSearchParams(window.location.search);
            const externalId = urlParams.get('external_id') || urlParams.get('id');
            if (externalId) {
                const orderRef = document.getElementById('orderReference');
                if (orderRef) {
                    orderRef.textContent = externalId;
                }
            }
        });

        function copyOrderRef() {
            const orderRefText = document.getElementById('orderReference').textContent;
            navigator.clipboard.writeText(orderRefText).then(() => {
                const copyBtn = document.getElementById('copyOrderRefBtn');
                copyBtn.textContent = 'Copied!';
                setTimeout(() => {
                    copyBtn.textContent = 'Copy';
                }, 2000);
            });
        }
    </script>
</body>

</html>
