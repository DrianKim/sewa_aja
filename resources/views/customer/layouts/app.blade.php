<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sewa Aja</title>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            border-top: 1px solid #e5e7eb;
            padding: 8px 0;
            z-index: 50;
        }

        .nav-item {
            flex: 1;
            text-align: center;
            padding: 8px 4px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .nav-item.active {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        .nav-item:active {
            transform: scale(0.95);
        }

        .content-area {
            padding-bottom: 80px;
            /* Space for bottom nav */
        }

        /* Mobile first design */
        .container-mobile {
            width: 100%;
            margin: 0 auto;
            padding: 0 16px;
        }

        @media (min-width: 768px) {
            .container-mobile {
                max-width: 768px;
                padding: 0 24px;
            }
        }

        @media (min-width: 1024px) {
            .container-mobile {
                max-width: 1024px;
            }
        }

        /* Touch friendly buttons */
        .btn-mobile {
            min-height: 44px;
            padding: 12px 20px;
            font-size: 16px;
            /* Prevent zoom on iOS */
        }

        .input-mobile {
            min-height: 48px;
            font-size: 16px;
            /* Prevent zoom on iOS */
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-40">
        <div class="container-mobile">
            <div class="flex items-center justify-between py-4">
                <!-- Back Button (conditional) -->
                @hasSection('back-button')
                    @yield('back-button')
                @else
                    <button onclick="window.history.back()"
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 active:scale-95 transition-all">
                        <i class="fas fa-arrow-left text-gray-600"></i>
                    </button>
                @endif

                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <i class="fas fa-car-side text-blue-600 text-xl"></i>
                    <span
                        class="font-bold text-lg bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                        Sewa Aja
                    </span>
                </div>

                <!-- User Menu -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-200 active:scale-95 transition-all">
                        <i class="fas fa-user"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50">
                        <a href="{{ route('user.profile') }}"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-user-edit w-5"></i>
                            <span>Edit Profil</span>
                        </a>
                        <a href="{{ route('user.history') }}"
                            class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-history w-5"></i>
                            <span>Riwayat Sewa</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-3 text-red-600 hover:bg-red-50 transition-colors">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="content-area">
        <div class="container-mobile">
            @yield('content')
        </div>
    </main>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav lg:hidden">
        <div class="flex justify-around items-center">
            <a href="{{ route('user.home') }}" class="nav-item {{ request()->routeIs('user.home') ? 'active' : '' }}">
                <i class="fas fa-home text-lg mb-1"></i>
                <span class="text-xs font-medium">Beranda</span>
            </a>

            <a href="{{ route('user.products') }}"
                class="nav-item {{ request()->routeIs('user.products') ? 'active' : '' }}">
                <i class="fas fa-car text-lg mb-1"></i>
                <span class="text-xs font-medium">Sewa</span>
            </a>

            <a href="{{ route('user.history') }}"
                class="nav-item {{ request()->routeIs('user.history') ? 'active' : '' }}">
                <i class="fas fa-history text-lg mb-1"></i>
                <span class="text-xs font-medium">Riwayat</span>
            </a>

            <a href="{{ route('user.profile') }}"
                class="nav-item {{ request()->routeIs('user.profile') ? 'active' : '' }}">
                <i class="fas fa-user text-lg mb-1"></i>
                <span class="text-xs font-medium">Profil</span>
            </a>
        </div>
    </nav>

    <!-- Desktop Sidebar (hidden on mobile) -->
    <aside class="hidden lg:block fixed left-0 top-0 h-full w-64 bg-white shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <i class="fas fa-car-side text-blue-600 text-2xl"></i>
                <span
                    class="font-bold text-xl bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                    Sewa Aja
                </span>
            </div>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('user.home') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('user.home') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-home w-5"></i>
                <span>Beranda</span>
            </a>

            <a href="{{ route('user.products') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('user.products') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-car w-5"></i>
                <span>Sewa Kendaraan</span>
            </a>

            <a href="{{ route('user.history') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('user.history') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-history w-5"></i>
                <span>Riwayat Sewa</span>
            </a>

            <a href="{{ route('user.profile') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('user.profile') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-user-edit w-5"></i>
                <span>Edit Profil</span>
            </a>
        </nav>
    </aside>

    <!-- Script for mobile interactions -->
    <script>
        // Touch feedback for buttons
        document.addEventListener('touchstart', function() {}, {
            passive: true
        });

        // Prevent body scroll when dropdown is open
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
                toggle() {
                    this.open = !this.open
                }
            }))
        });

        // Auto-hide address bar on mobile
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.scrollTo(0, 1);
            }, 0);
        });

        // Add loading states for better UX
        document.addEventListener('submit', function(e) {
            const form = e.target;
            const submitBtn = form.querySelector('button[type="submit"]');

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
