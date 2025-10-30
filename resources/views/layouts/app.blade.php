<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Sewa Aja')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Smooth Transitions */
        * {
            transition: all 0.3s ease;
        }

        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            display: flex;
        }

        /* Sidebar Gradient Animation */
        .sidebar-gradient {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .sidebar-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Glassmorphism Effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Sidebar Menu Hover Effect */
        .menu-item {
            position: relative;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 4px;
            height: 0;
            background: white;
            transform: translateY(-50%);
            transition: height 0.3s ease;
        }

        .menu-item:hover::before,
        .menu-item.active::before {
            height: 70%;
        }

        .menu-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .menu-item.active {
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        /* Logo Animation */
        .logo-icon {
            animation: pulse-logo 2s ease-in-out infinite;
        }

        @keyframes pulse-logo {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        /* Profile Dropdown */
        .profile-dropdown {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-dropdown:hover {
            transform: translateY(-2px);
        }

        .profile-dropdown:hover .profile-badge {
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }

        /* Notification Badge */
        .notification-badge {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes ping {

            75%,
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Mobile Menu Toggle */
        .mobile-menu-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }
        }

        /* Logout Button Hover */
        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.1);
            transform: translateX(5px);
        }

        /* Header Glass Effect */
        .header-glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Sidebar Fixed Height */
        .sidebar {
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 40;
            width: 16rem;
            /* 64, pastikan sesuai Tailwind */
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding-bottom: 20px;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 1rem;
        }

        /* Main Content Proper Spacing */
        .main-content {
            min-height: 100vh;
            padding-bottom: 2rem;
            position: relative;
            z-index: 10;
            margin-left: 16rem;
            flex: 1;
        }

        /* Header Z-index Fix */
        .header-glass {
            position: sticky;
            top: 0;
            z-index: 30;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100">

    {{-- Sidebar Admin --}}
    <aside class="sidebar w-64 sidebar-gradient shadow-2xl fixed left-0 top-0">
        <div class="relative z-10 h-full flex flex-col">
            <!-- Logo Section -->
            <div class="flex items-center space-x-3 p-6 pb-4 border-b border-white/20">
                <div
                    class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center logo-icon shadow-lg">
                    <i class="fas fa-car-side text-white text-xl"></i>
                </div>
                <div>
                    <span class="text-2xl font-bold text-white block">Sewa Aja</span>
                    <span class="text-xs text-white/70">Rental Management</span>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="sidebar-content px-4 pt-6">
                <ul class="space-y-2 text-white">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="menu-item flex items-center px-4 py-3 rounded-xl
                           {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt w-5 mr-4 text-lg"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>

                    <!-- Kendaraan -->
                    <li>
                        <a href="{{ route('kendaraan.index') }}"
                            class="menu-item flex items-center px-4 py-3 rounded-xl
                           {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">
                            <i class="fas fa-car w-5 mr-4 text-lg"></i>
                            <span class="font-medium">Data Kendaraan</span>
                        </a>
                    </li>

                    <!-- Kategori -->
                    <li>
                        <a href="{{ route('kategori.index') }}"
                            class="menu-item flex items-center px-4 py-3 rounded-xl
                           {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                            <i class="fas fa-tags w-5 mr-4 text-lg"></i>
                            <span class="font-medium">Kategori</span>
                        </a>
                    </li>

                    <!-- Detail -->
                    <li>
                        <a href="{{ route('detail.index') }}"
                            class="menu-item flex items-center px-4 py-3 rounded-xl
                           {{ request()->routeIs('detail.*') ? 'active' : '' }}">
                            <i class="fas fa-list-alt w-5 mr-4 text-lg"></i>
                            <span class="font-medium">Detail Kendaraan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar Footer -->
            <div class="sidebar-footer border-t border-white/20">
                <!-- Admin Info -->
                <div class="p-4 bg-white/10 backdrop-blur-lg rounded-xl mb-3 mx-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-semibold text-sm">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-white/70 text-xs">Administrator</p>
                        </div>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="px-4">
                    @csrf
                    <button type="button" id="logout-btn"
                        class="logout-btn w-full text-left flex items-center px-4 py-3 rounded-xl text-white hover:text-red-200">
                        <i class="fas fa-sign-out-alt w-5 mr-4 text-lg"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Mobile Menu Toggle --}}
    <button
        class="mobile-menu-btn fixed top-4 left-4 z-50 w-10 h-10 bg-white rounded-lg shadow-lg flex items-center justify-center">
        <i class="fas fa-bars text-gray-700"></i>
    </button>

    {{-- Main Content --}}
    <div class="main-content">
        <!-- Header -->
        <header class="header-glass flex justify-between items-center mb-8 p-6 shadow-lg">
            <div>
                <h1 class="text-3xl font-bold gradient-text">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center gap-3 mt-2">
                    <p class="text-gray-600 text-sm font-medium" id="current-date"></p>
                    <span class="text-gray-400">•</span>
                    <p class="text-gray-600 text-sm font-medium" id="current-time"></p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Notification -->
                <div class="relative cursor-pointer hover:scale-110 transition-transform">
                    <div
                        class="w-11 h-11 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-bell text-white"></i>
                    </div>
                    <span
                        class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                        3
                    </span>
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full notification-badge"></span>
                </div>

                <!-- Profile -->
                <div
                    class="profile-dropdown flex items-center space-x-3 bg-gradient-to-r from-blue-50 to-purple-50 px-4 py-2 rounded-xl hover:shadow-md">
                    <div
                        class="profile-badge w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <p class="text-gray-800 font-semibold text-sm">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-gray-500 text-xs">Administrator</p>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-12 text-center text-gray-500 text-sm py-6 border-t border-gray-200">
            <div
                class="fixed bottom-0 w-full flex items-center gap-2 bg-white/90 border-t border-gray-200 px-4 py-3 z-50 shadow">
                <span class="font-bold text-gray-500 text-base">Made With</span>
                <span class="mx-1 text-xl text-gray-400"><i class="fas fa-heart"></i></span>
                <span class="font-bold text-gray-700 text-base">By</span>
                <a href="#"><span class="font-bold text-blue-500 text-xl">𝓟</span></a>
            </div>
        </footer>
    </div>


    <!-- Mobile Menu Script -->
    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const sidebar = document.querySelector('.sidebar');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Profile Dropdown (optional - add your own logic)
        const profileDropdown = document.querySelector('.profile-dropdown');
        if (profileDropdown) {
            profileDropdown.addEventListener('click', () => {
                // Add dropdown menu logic here
                console.log('Profile clicked');
            });
        }

        // SweetAlert Logout Confirmation
        const logoutBtn = document.getElementById('logout-btn');
        const logoutForm = document.getElementById('logout-form');

        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Yakin ingin logout?',
                    text: "Anda akan keluar dari sesi ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Logout!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'animated fadeInDown'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Anda akan segera logout...',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            // Submit the logout form
                            logoutForm.submit();
                        });
                    }
                });
            });
        }

        // SweetAlert for Success Messages (jika ada flash message)
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal2-popup',
                    confirmButton: 'swal2-confirm'
                },
                buttonsStyling: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'swal2-popup',
                    confirmButton: 'swal2-confirm'
                },
                buttonsStyling: false
            });
        @endif
    </script>

    <script>
        // Real-time Date and Time Display
        function updateDateTime() {
            const now = new Date();

            // Array untuk hari dan bulan dalam Bahasa Indonesia
            const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Get date components
            const namaHari = hari[now.getDay()];
            const tanggal = now.getDate();
            const namaBulan = bulan[now.getMonth()];
            const tahun = now.getFullYear();

            // Get time components
            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');

            // Format date and time
            const formattedDate = `${namaHari}, ${tanggal} ${namaBulan} ${tahun}`;
            const formattedTime = `${jam}:${menit}:${detik} WIB`;

            // Update the DOM
            document.getElementById('current-date').textContent = formattedDate;
            document.getElementById('current-time').textContent = formattedTime;
        }

        // Update every second
        setInterval(updateDateTime, 1000);

        // Initial call
        updateDateTime();
    </script>

</body>

</html>
