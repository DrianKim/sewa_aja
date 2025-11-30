<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SewaAja - Premium Vehicle Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .hero-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }

        .category-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .smooth-scroll {
            scroll-behavior: smooth;
        }

        .navbar-shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Mobile responsive improvements */
        @media (max-width: 768px) {
            .mobile-padding {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .mobile-text-center {
                text-align: center;
            }

            .mobile-stack {
                flex-direction: column;
            }

            .mobile-full-width {
                width: 100%;
            }
        }
    </style>
</head>

<body class="smooth-scroll bg-gray-50">
    <!-- NAVBAR -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white navbar-shadow">
        <div class="container mx-auto px-4 md:px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-car text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold gradient-text">SewaAja</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-blue-600 font-medium transition">Beranda</a>
                    <a href="#tentang" class="text-gray-700 hover:text-blue-600 font-medium transition">Tentang</a>
                    <a href="#kendaraan" class="text-gray-700 hover:text-blue-600 font-medium transition">Kendaraan</a>
                    <a href="#layanan" class="text-gray-700 hover:text-blue-600 font-medium transition">Layanan</a>
                    <a href="#kontak" class="text-gray-700 hover:text-blue-600 font-medium transition">Kontak</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="/login"
                        class="px-5 py-2.5 text-gray-700 font-semibold hover:text-blue-600 transition">Masuk</a>
                    <a href="/register"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold rounded-full hover:shadow-lg transition transform hover:scale-105">Daftar</a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 space-y-3">
                <a href="#home" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Beranda</a>
                <a href="#tentang" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Tentang</a>
                <a href="#kendaraan" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Kendaraan</a>
                <a href="#layanan" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Layanan</a>
                <a href="#kontak" class="block py-2 text-gray-700 hover:text-blue-600 font-medium">Kontak</a>
                <div class="pt-3 space-y-2">
                    <a href="/login"
                        class="block py-2.5 text-center border-2 border-blue-600 text-blue-600 font-semibold rounded-full">Masuk</a>
                    <a href="/register"
                        class="block py-2.5 text-center bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold rounded-full">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="home" class="hero-gradient pt-32 pb-20 text-white overflow-hidden">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col lg:flex-row items-center gap-8 md:gap-12">
                <!-- Left Content -->
                <div class="lg:w-1/2 space-y-6 mobile-text-center">
                    <div class="inline-block px-4 py-2 glass-effect rounded-full text-sm font-semibold">
                        🚀 Platform Rental #1 di Indonesia
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-tight">
                        Sewa Kendaraan<br>
                        <span class="text-yellow-300">Premium</span> dengan Mudah
                    </h1>
                    <p class="text-lg text-blue-100 leading-relaxed">
                        Pengalaman rental kendaraan terbaik dengan armada modern, harga transparan, dan pelayanan 24/7.
                        Mulai perjalananmu sekarang!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 pt-4 mobile-stack">
                        <a href="#kendaraan"
                            class="px-6 md:px-8 py-4 bg-white text-blue-600 font-bold rounded-full shadow-xl hover:shadow-2xl transition transform hover:scale-105 text-center mobile-full-width">
                            <i class="fas fa-car mr-2"></i> Jelajahi Kendaraan
                        </a>
                        <a href="/register"
                            class="px-6 md:px-8 py-4 border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-blue-600 transition text-center mobile-full-width">
                            <i class="fas fa-user-plus mr-2"></i> Daftar Gratis
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="flex gap-6 md:gap-8 pt-8 justify-center md:justify-start">
                        <div class="text-center md:text-left">
                            <div class="text-2xl md:text-3xl font-bold">500+</div>
                            <div class="text-blue-200 text-sm">Kendaraan</div>
                        </div>
                        <div class="text-center md:text-left">
                            <div class="text-2xl md:text-3xl font-bold">10K+</div>
                            <div class="text-blue-200 text-sm">Pelanggan</div>
                        </div>
                        <div class="text-center md:text-left">
                            <div class="text-2xl md:text-3xl font-bold">24/7</div>
                            <div class="text-blue-200 text-sm">Layanan</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Vehicle Illustrations -->
                <div class="lg:w-1/2 relative mt-8 md:mt-0">
                    <div class="relative h-64 md:h-80 lg:h-96">
                        <!-- Main Car Illustration -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-48 h-24 md:w-64 md:h-32 lg:w-80 lg:h-40 bg-white/20 rounded-2xl backdrop-blur-sm border border-white/30 flex items-center justify-center animate-float">
                                <i class="fas fa-car-side text-white text-4xl md:text-5xl lg:text-6xl"></i>
                            </div>
                        </div>

                        <!-- Floating Vehicles -->
                        <div class="absolute top-4 left-4 w-16 h-10 bg-white/20 rounded-xl backdrop-blur-sm border border-white/30 flex items-center justify-center animate-float"
                            style="animation-delay: 0.5s;">
                            <i class="fas fa-motorcycle text-white text-xl"></i>
                        </div>

                        <div class="absolute top-12 right-8 w-14 h-8 bg-white/20 rounded-xl backdrop-blur-sm border border-white/30 flex items-center justify-center animate-float"
                            style="animation-delay: 1s;">
                            <i class="fas fa-bicycle text-white text-lg"></i>
                        </div>

                        <div class="absolute bottom-16 left-8 w-20 h-12 bg-white/20 rounded-xl backdrop-blur-sm border border-white/30 flex items-center justify-center animate-float"
                            style="animation-delay: 1.5s;">
                            <i class="fas fa-truck text-white text-2xl"></i>
                        </div>

                        <div class="absolute bottom-8 right-4 w-16 h-10 bg-white/20 rounded-xl backdrop-blur-sm border border-white/30 flex items-center justify-center animate-float"
                            style="animation-delay: 2s;">
                            <i class="fas fa-bus text-white text-xl"></i>
                        </div>

                        <!-- Animated Circles -->
                        <div
                            class="absolute top-1/4 left-1/4 w-8 h-8 border-2 border-white/30 rounded-full animate-pulse">
                        </div>
                        <div class="absolute bottom-1/3 right-1/3 w-6 h-6 border-2 border-white/30 rounded-full animate-pulse"
                            style="animation-delay: 1s;"></div>
                        <div class="absolute top-1/3 right-1/4 w-4 h-4 border-2 border-white/30 rounded-full animate-pulse"
                            style="animation-delay: 2s;"></div>
                    </div>

                    <!-- Floating Cards -->
                    <div
                        class="absolute top-4 -left-4 md:top-10 md:-left-10 bg-white text-gray-800 px-3 md:px-4 py-2 md:py-3 rounded-xl shadow-xl animate-float">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="font-semibold text-sm md:text-base">Terverifikasi</span>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -right-4 md:bottom-10 md:-right-10 bg-white text-gray-800 px-3 md:px-4 py-2 md:py-3 rounded-xl shadow-xl animate-float"
                        style="animation-delay: 1s;">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-shield-alt text-blue-500"></i>
                            <span class="font-semibold text-sm md:text-base">Aman & Terpercaya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="tentang" class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Kenapa Pilih <span
                        class="gradient-text">SewaAja?</span></h2>
                <p class="text-gray-600 text-base md:text-lg">Kami memberikan pengalaman rental terbaik untuk setiap
                    perjalananmu</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 md:gap-8">
                <!-- Feature 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 md:p-8 rounded-2xl hover-lift">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center mb-4 md:mb-6">
                        <i class="fas fa-shield-alt text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">100% Aman & Terpercaya</h3>
                    <p class="text-gray-600 text-sm md:text-base">Semua kendaraan diasuransikan dan melalui pengecekan
                        rutin. Keamananmu
                        adalah prioritas kami.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 md:p-8 rounded-2xl hover-lift">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center mb-4 md:mb-6">
                        <i class="fas fa-tags text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">Harga Terbaik</h3>
                    <p class="text-gray-600 text-sm md:text-base">Harga transparan tanpa biaya tersembunyi. Dapatkan
                        promo menarik setiap
                        bulannya!</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 md:p-8 rounded-2xl hover-lift">
                    <div
                        class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl flex items-center justify-center mb-4 md:mb-6">
                        <i class="fas fa-headset text-white text-xl md:text-2xl"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">Support 24/7</h3>
                    <p class="text-gray-600 text-sm md:text-base">Tim customer service kami siap membantu kapan saja.
                        Chat, telepon, atau
                        email - kami ada untukmu!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- VEHICLE CATEGORIES -->
    <section id="kendaraan" class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Pilihan Kendaraan <span
                        class="gradient-text">Premium</span></h2>
                <p class="text-gray-600 text-base md:text-lg">Dari motor hingga mobil mewah, semua ada di sini</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 md:gap-8">
                <!-- Vehicle Card 1 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover-lift">
                    <div class="relative h-48 md:h-56 overflow-hidden">
                        <img src="{{ asset('img/Toyota-Avanza.jpg') }}" alt="Toyota Avanza"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg md:text-xl font-bold text-gray-800">Toyota Avanza</h3>
                            <div class="flex items-center gap-1 text-blue-600">
                                <i class="fas fa-users"></i>
                                <span class="font-semibold text-sm">7 Kursi</span>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm md:text-base mb-4">Mobil keluarga nyaman dengan kapasitas 7
                            penumpang</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xl md:text-2xl font-bold text-blue-600">Rp 350K</span>
                                <span class="text-gray-500 text-sm md:text-base">/hari</span>
                            </div>
                            <a href="/login"
                                class="px-4 md:px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold rounded-full hover:shadow-lg transition text-sm md:text-base">
                                Sewa
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Card 2 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover-lift">
                    <div class="relative h-48 md:h-56 overflow-hidden">
                        <img src="{{ asset('img/Honda-Vario-160.jpg') }}" alt="Honda Vario"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Tersedia
                        </div>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg md:text-xl font-bold text-gray-800">Honda Vario 160</h3>
                            <div class="flex items-center gap-1 text-blue-600">
                                <i class="fas fa-gas-pump"></i>
                                <span class="font-semibold text-sm">Irit</span>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm md:text-base mb-4">Motor matic sporty dan irit bahan bakar</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xl md:text-2xl font-bold text-blue-600">Rp 80K</span>
                                <span class="text-gray-500 text-sm md:text-base">/hari</span>
                            </div>
                            <a href="/login"
                                class="px-4 md:px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold rounded-full hover:shadow-lg transition text-sm md:text-base">
                                Sewa
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Card 3 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover-lift">
                    <div class="relative h-48 md:h-56 overflow-hidden">
                        <img src="{{ asset('img/Mercedes-Benz.jpg') }}" alt="Mercedes Benz"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Premium
                        </div>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg md:text-xl font-bold text-gray-800">Mercedes Benz</h3>
                            <div class="flex items-center gap-1 text-blue-600">
                                <i class="fas fa-crown"></i>
                                <span class="font-semibold text-sm">Mewah</span>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm md:text-base mb-4">Mobil mewah untuk acara spesial dan bisnis
                        </p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-xl md:text-2xl font-bold text-blue-600">Rp 1.5JT</span>
                                <span class="text-gray-500 text-sm md:text-base">/hari</span>
                            </div>
                            <a href="/login"
                                class="px-4 md:px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-semibold rounded-full hover:shadow-lg transition text-sm md:text-base">
                                Sewa
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8 md:mt-12">
                <a href="/login"
                    class="inline-block px-6 md:px-8 py-3 md:py-4 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold rounded-full shadow-xl hover:shadow-2xl transition transform hover:scale-105 text-sm md:text-base">
                    Lihat Semua Kendaraan <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section id="layanan" class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4 md:px-6">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Layanan <span
                        class="gradient-text">Kami</span></h2>
                <p class="text-gray-600 text-base md:text-lg">Berbagai layanan untuk kenyamanan perjalananmu</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <div class="text-center p-4 md:p-6 rounded-xl hover:bg-gray-50 transition">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <i class="fas fa-map-marked-alt text-blue-600 text-lg md:text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Antar Jemput</h4>
                    <p class="text-gray-600 text-xs md:text-sm">Gratis antar ke lokasi</p>
                </div>

                <div class="text-center p-4 md:p-6 rounded-xl hover:bg-gray-50 transition">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <i class="fas fa-tools text-blue-600 text-lg md:text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Full Service</h4>
                    <p class="text-gray-600 text-xs md:text-sm">Kendaraan terawat</p>
                </div>

                <div class="text-center p-4 md:p-6 rounded-xl hover:bg-gray-50 transition">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <i class="fas fa-mobile-alt text-blue-600 text-lg md:text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Booking Online</h4>
                    <p class="text-gray-600 text-xs md:text-sm">Proses cepat & mudah</p>
                </div>

                <div class="text-center p-4 md:p-6 rounded-xl hover:bg-gray-50 transition">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                        <i class="fas fa-clock text-blue-600 text-lg md:text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Fleksibel</h4>
                    <p class="text-gray-600 text-xs md:text-sm">Sewa per jam/hari</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="py-16 md:py-20 hero-gradient text-white">
        <div class="container mx-auto px-4 md:px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Memulai Perjalananmu?</h2>
            <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Daftar sekarang dan dapatkan diskon 20%
                untuk
                rental pertamamu!</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center mobile-stack">
                <a href="/register"
                    class="px-6 md:px-8 py-3 md:py-4 bg-white text-blue-600 font-bold rounded-full shadow-xl hover:shadow-2xl transition transform hover:scale-105 text-center mobile-full-width">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Gratis
                </a>
                <a href="/login"
                    class="px-6 md:px-8 py-3 md:py-4 border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-blue-600 transition text-center mobile-full-width">
                    <i class="fas fa-sign-in-alt mr-2"></i> Sudah Punya Akun
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 py-8 md:py-12">
        <div class="container mx-auto px-4 md:px-6">
            <div class="grid md:grid-cols-4 gap-6 md:gap-8 mb-6 md:mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                            <i class="fas fa-car text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-white">SewaAja</span>
                    </div>
                    <p class="text-sm">Platform rental kendaraan terpercaya di Indonesia. Perjalanan nyaman dimulai
                        dari sini.</p>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#kendaraan" class="hover:text-white transition">Kendaraan</a></li>
                        <li><a href="#layanan" class="hover:text-white transition">Layanan</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li><i class="fas fa-phone mr-2"></i> +62 812-3456-7890</li>
                        <li><i class="fas fa-envelope mr-2"></i> info@sewaaja.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Subang, Indonesia</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Ikuti Kami</h4>
                    <div class="flex gap-3">
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-6 md:pt-8 text-center text-sm">
                <p>&copy; 2025 SewaAja. Made with <i class="fas fa-heart text-red-500"></i> by <span
                        class="font-bold gradient-text text-xl">𝓟</span></p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    mobileMenu.classList.add('hidden');
                }
            });
        });

        // Navbar shadow on scroll
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });
    </script>
</body>

</html>
