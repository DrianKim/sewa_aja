<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Aja - Rental Kendaraan</title>

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
</head>

<body class="text-gray-800 bg-gray-50">
    <!-- NAVBAR -->
    <nav class="fixed z-50 w-full bg-white shadow-md">
        <div class="container flex items-center justify-between p-4 mx-auto">
            <h1 class="text-2xl font-bold text-blue-600">Sewa<span class="text-gray-900">Aja</span></h1>

            <div class="items-center hidden gap-6 text-sm font-semibold md:flex">
                <a href="#home" class="transition hover:text-blue-600">Beranda</a>
                <a href="#about" class="transition hover:text-blue-600">Tentang</a>
                <a href="#kendaraan" class="transition hover:text-blue-600">Kendaraan</a>
                <a href="#kontak" class="transition hover:text-blue-600">Kontak</a>
            </div>

            <a href="/login"
                class="hidden px-4 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700 md:block">Masuk</a>

            <button class="text-2xl md:hidden" @click="open = !open" x-data="{ open: false }">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" class="p-4 bg-white shadow-md md:hidden" x-transition>
            <a href="#home" class="block py-2">Beranda</a>
            <a href="#about" class="block py-2">Tentang</a>
            <a href="#kendaraan" class="block py-2">Kendaraan</a>
            <a href="#kontak" class="block py-2">Kontak</a>
            <a href="/login" class="block py-2 font-semibold text-blue-600">Masuk</a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="home" class="pb-20 text-white pt-28 bg-gradient-to-r from-blue-600 to-blue-400">
        <div class="container flex flex-col items-center gap-10 px-6 mx-auto md:flex-row">
            <div class="md:w-1/2">
                <h2 class="text-4xl font-extrabold leading-tight md:text-5xl">Rental Kendaraan Cepat & Mudah</h2>
                <p class="mt-4 text-lg opacity-90">Temukan kendaraan terbaik untuk kebutuhan perjalananmu. Proses mudah,
                    harga bersahabat, dan kendaraan siap jalan!</p>
                <div class="flex gap-4 mt-6">
                    <a href="#kendaraan"
                        class="px-5 py-3 font-bold text-blue-600 transition bg-white shadow rounded-xl hover:bg-gray-100">Lihat
                        Kendaraan</a>
                    <a href="/login"
                        class="px-5 py-3 font-bold transition border border-white rounded-xl hover:bg-white hover:text-blue-600">Sewa
                        Sekarang</a>
                </div>
            </div>

            <div class="flex justify-center md:w-1/2">
                <img src="https://cdn.prod.website-files.com/636b5ba22b05ad5844d87a48/64687eb2418bbf614bed3d84_landing-page-car-rental.png"
                    class="w-96 drop-shadow-xl" />
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-20 bg-white">
        <div class="container px-6 mx-auto text-center">
            <h3 class="mb-6 text-3xl font-bold">Kenapa Memilih <span class="text-blue-600">SewaAja?</span></h3>

            <div class="grid gap-10 mt-10 md:grid-cols-3">
                <div class="p-6 transition bg-gray-100 shadow rounded-xl hover:shadow-lg">
                    <i class="text-4xl text-blue-600 fa-solid fa-car"></i>
                    <h4 class="mt-4 text-xl font-bold">Banyak Pilihan</h4>
                    <p class="mt-2 text-gray-600">Mulai dari motor, mobil city car, hingga mobil keluarga.</p>
                </div>

                <div class="p-6 transition bg-gray-100 shadow rounded-xl hover:shadow-lg">
                    <i class="text-4xl text-blue-600 fa-solid fa-wallet"></i>
                    <h4 class="mt-4 text-xl font-bold">Harga Bersahabat</h4>
                    <p class="mt-2 text-gray-600">Harga jujur tanpa biaya tersembunyi. Cocok buat kantong pelajar sampai
                        keluarga.</p>
                </div>

                <div class="p-6 transition bg-gray-100 shadow rounded-xl hover:shadow-lg">
                    <i class="text-4xl text-blue-600 fa-solid fa-shield-halved"></i>
                    <h4 class="mt-4 text-xl font-bold">Aman & Terpercaya</h4>
                    <p class="mt-2 text-gray-600">Unit selalu servis berkala dan siap dipakai kapan saja.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KENDARAAN LIST PREVIEW -->
    <section id="kendaraan" class="py-20 bg-gray-50">
        <div class="container px-6 mx-auto text-center">
            <h3 class="mb-10 text-3xl font-bold">Pilihan Kendaraan</h3>

            <div class="grid gap-8 md:grid-cols-3">
                <!-- CARD 1 -->
                <div class="p-4 transition bg-white shadow rounded-xl hover:shadow-xl">
                    <img src="https://images.unsplash.com/photo-1605559424843-9e4c924d0e1b?auto=format&fit=crop&w=800&q=80"
                        class="object-cover w-full h-40 rounded-lg">
                    <h4 class="mt-4 text-xl font-bold">Toyota Avanza</h4>
                    <p class="text-gray-600">Mobil keluarga nyaman & irit</p>
                    <a href="/login"
                        class="inline-block px-5 py-2 mt-4 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">Sewa
                        Sekarang</a>
                </div>


                <!-- CARD 2 -->
                <div class="p-4 transition bg-white shadow rounded-xl hover:shadow-xl">
                    <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90f6?auto=format&fit=crop&w=800&q=80"
                        class="object-cover w-full h-40 rounded-lg">
                    <h4 class="mt-4 text-xl font-bold">Honda Vario 160</h4>
                    <p class="text-gray-600">Motor matic kenceng & simple</p>
                    <a href="/login"
                        class="inline-block px-5 py-2 mt-4 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">Sewa
                        Sekarang</a>
                </div>


                <!-- CARD 3 -->
                <div class="p-4 transition bg-white shadow rounded-xl hover:shadow-xl">
                    <img src="https://images.unsplash.com/photo-1516641398379-3a9b1f6f3f56?auto=format&fit=crop&w=800&q=80"
                        class="object-cover w-full h-40 rounded-lg">
                    <h4 class="mt-4 text-xl font-bold">Scooter Vespa</h4>
                    <p class="text-gray-600">Gaya klasik cocok buat jalan santai</p>
                    <a href="/login"
                        class="inline-block px-5 py-2 mt-4 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">Sewa
                        Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="kontak" class="py-8 text-center text-gray-600 bg-white border-t">
        <p>&copy; 2025 SewaAja. All rights reserved.</p>
        <span class="text-base font-bold text-gray-500">Made With</span>
        <span class="mx-1 text-xl text-gray-400"><i class="fas fa-heart"></i></span>
        <span class="text-base font-bold text-gray-700">By</span>
        <a href="#"><span class="text-xl font-bold text-blue-500">𝓟</span></a>
    </footer>
</body>

</html>
