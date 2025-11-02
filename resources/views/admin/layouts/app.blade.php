<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin - Sewa Aja')</title>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Material Icons -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

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
    <aside class="fixed top-0 left-0 w-64 shadow-2xl sidebar sidebar-gradient">
        <div class="relative z-10 flex flex-col h-full">
            <!-- Logo Section -->
            <div class="flex items-center p-6 pb-4 space-x-3 border-b border-white/20">
                {{-- <div
                    class="flex items-center justify-center w-12 h-12 shadow-lg bg-white/20 backdrop-blur-lg rounded-xl logo-icon">
                    <i class="text-xl text-white fas fa-car-side"></i>
                </div> --}}
                <div
                    class="flex items-center justify-center w-12 h-12 shadow-lg bg-white/20 backdrop-blur-lg rounded-xl logo-icon">
                    <span class="text-2xl text-white material-symbols-outlined"
                        style="font-variation-settings: 'FILL' 1;">
                        garage
                    </span>
                </div>
                <div>
                    <span class="block text-2xl font-bold text-white">Sewa Aja</span>
                    <span class="text-xs text-white/70">Rental Management</span>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="px-4 pt-6 sidebar-content">
                <ul class="space-y-2 text-white">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="menu-item flex items-center px-4 py-3 rounded-xl
                           {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="w-5 mr-4 text-lg fas fa-tachometer-alt"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>

                    <!-- Kendaraan -->
                    <li>
                        <a href="{{ route('kendaraan.index') }}"
                            class="menu-item flex items-center px-4 py-3 rounded-xl
                           {{ request()->routeIs('kendaraan.*') ? 'active' : '' }}">
                            <i class="w-5 mr-4 text-lg fas fa-car"></i>
                            <span class="font-medium">Data Kendaraan</span>
                        </a>
                    </li>

                    <!-- Kategori -->
                    <li>
                        <a href="{{ route('kategori.index') }}"
                            class="menu-item flex items-center px-4 py-3 rounded-xl
                           {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                            <i class="w-5 mr-4 text-lg fas fa-tags"></i>
                            <span class="font-medium">Kategori</span>
                        </a>
                    </li>

                    <!-- Detail -->
                    <li>
                        <a href="{{ route('detail.index') }}"
                            class="menu-item flex items-center px-4 py-3 rounded-xl
                           {{ request()->routeIs('detail.*') ? 'active' : '' }}">
                            <i class="w-5 mr-4 text-lg fas fa-list-alt"></i>
                            <span class="font-medium">Detail Kendaraan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sidebar Footer -->
            <div class="border-t sidebar-footer border-white/20">
                <!-- Admin Info -->
                {{-- <div class="p-4 mx-4 mb-3 bg-white/10 backdrop-blur-lg rounded-xl">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-white/20">
                            <i class="text-white fas fa-user"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-white">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-white/70">Administrator</p>
                        </div>
                    </div>
                </div> --}}

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="px-4">
                    @csrf
                    <button type="button" id="logout-btn"
                        class="flex items-center w-full px-4 py-3 text-left text-white logout-btn rounded-xl hover:text-red-200">
                        <i class="w-5 mr-4 text-lg fas fa-sign-out-alt"></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Mobile Menu Toggle --}}
    <button
        class="fixed z-50 flex items-center justify-center w-10 h-10 bg-white rounded-lg shadow-lg mobile-menu-btn top-4 left-4">
        <i class="text-gray-700 fas fa-bars"></i>
    </button>

    {{-- Main Content --}}
    <div class="main-content">
        <!-- Header -->
        <header class="flex items-center justify-between p-6 mb-8 shadow-lg header-glass">
            <div>
                <h1 class="text-3xl font-bold gradient-text">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center gap-3 mt-2">
                    <p class="text-sm font-medium text-gray-600" id="current-date"></p>
                    <span class="text-gray-400">•</span>
                    <p class="text-sm font-medium text-gray-600" id="current-time"></p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Notification -->
                <div class="relative transition-transform cursor-pointer hover:scale-110">
                    <div
                        class="flex items-center justify-center shadow-lg w-11 h-11 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl">
                        <i class="text-white fas fa-bell"></i>
                    </div>
                    <span
                        class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full -top-1 -right-1">
                        3
                    </span>
                    <span class="absolute w-5 h-5 bg-red-500 rounded-full -top-1 -right-1 notification-badge"></span>
                </div>

                <!-- Profile -->
                <div
                    class="flex items-center px-4 py-2 space-x-3 profile-dropdown bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl hover:shadow-md">
                    <div
                        class="flex items-center justify-center w-10 h-10 shadow-md profile-badge bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl">
                        <i class="text-white fas fa-user"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <i class="text-xs text-gray-400 fas fa-chevron-down"></i>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="py-6 mt-12 text-sm text-center text-gray-500 border-t border-gray-200">
            <div
                class="fixed bottom-0 z-50 flex items-center w-full gap-2 px-4 py-3 border-t border-gray-200 shadow bg-white/90">
                <span class="text-base font-bold text-gray-500">Made With</span>
                <span class="mx-1 text-xl text-gray-400"><i class="fas fa-heart"></i></span>
                <span class="text-base font-bold text-gray-700">By</span>
                <a href="#"><span class="text-xl font-bold text-blue-500">𝓟</span></a>
            </div>
        </footer>
    </div>

    <!-- Mobile Menu Script -->
    <script>
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const sidebar = document.querySelector('.sidebar');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        const profileDropdown = document.querySelector('.profile-dropdown');
        if (profileDropdown) {
            profileDropdown.addEventListener('click', () => {
                console.log('Profile clicked');
            });
        }

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
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Anda akan segera logout...',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            logoutForm.submit();
                        });
                    }
                });
            });
        }

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
            });
        @endif
    </script>

    <!-- Date and Time Script -->
    <script>
        function updateDateTime() {
            const now = new Date();

            const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const namaHari = hari[now.getDay()];
            const tanggal = now.getDate();
            const namaBulan = bulan[now.getMonth()];
            const tahun = now.getFullYear();

            const jam = String(now.getHours()).padStart(2, '0');
            const menit = String(now.getMinutes()).padStart(2, '0');
            const detik = String(now.getSeconds()).padStart(2, '0');

            const formattedDate = `${namaHari}, ${tanggal} ${namaBulan} ${tahun}`;
            const formattedTime = `${jam}:${menit}:${detik} WIB`;

            document.getElementById('current-date').textContent = formattedDate;
            document.getElementById('current-time').textContent = formattedTime;
        }

        setInterval(updateDateTime, 1000);

        updateDateTime();
    </script>

</body>

</html>
