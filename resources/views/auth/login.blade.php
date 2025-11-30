<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sewa Aja</title>

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
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="min-h-screen flex flex-col">
        <!-- Header dengan Back Button dan Logo -->
        <div class="flex items-center justify-between p-4 sm:p-6">
            <a href="{{ route('home') }}"
                class="flex items-center gap-2 px-4 py-2.5 text-gray-700 bg-white rounded-full hover:bg-gray-100 transition-all duration-300 active:scale-95 shadow-md">
                <i class="fas fa-arrow-left text-lg"></i>
            </a>

            <div
                class="flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 rounded-full shadow-lg">
                <i class="fas fa-car-side text-white text-xl"></i>
                <span class="text-white font-bold text-lg">Sewa Aja</span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center p-4">
            <div class="w-full max-w-6xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">

                    <!-- Ilustrasi / Avatar - Left Side on Desktop -->
                    <div class="flex justify-center order-1 lg:order-1">
                        <div
                            class="w-64 h-64 lg:w-96 lg:h-96 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center shadow-lg border-4 border-white">
                            <div class="text-center">
                                <i class="fas fa-user-circle text-blue-600 text-9xl lg:text-[12rem]"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Card Login - Right Side on Desktop -->
                    <div class="order-2 lg:order-2">
                        <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-10">
                            <!-- Title -->
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">Login Akun</h1>
                            <p class="text-gray-600 text-sm mb-6">
                                Belum Memiliki Akun?
                                <a href="{{ route('register') }}"
                                    class="text-blue-600 font-semibold hover:text-blue-700">Daftar Sekarang</a>
                            </p>

                            <!-- Alerts -->
                            @if (session('success'))
                                <div
                                    class="mb-4 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
                                    <i class="fas fa-check-circle text-green-600 mt-0.5"></i>
                                    <span class="text-green-800 text-sm">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
                                    <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                                    <span class="text-red-800 text-sm">{{ session('error') }}</span>
                                </div>
                            @endif

                            <!-- Form -->
                            <form method="POST" action="{{ route('login.proses') }}" class="space-y-4">
                                @csrf

                                <!-- Email Input -->
                                <div>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                                            class="w-full pl-12 pr-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all duration-300 text-gray-800 @error('email') border-red-400 bg-red-50 @enderror"
                                            placeholder="Email / No Handphone" required autocomplete="email">
                                    </div>
                                    @error('email')
                                        <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Password Input -->
                                <div>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" id="password" name="password"
                                            class="w-full pl-12 pr-12 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white focus:outline-none transition-all duration-300 text-gray-800 @error('password') border-red-400 bg-red-50 @enderror"
                                            placeholder="Password" required autocomplete="current-password">
                                        <button type="button" onclick="togglePassword()"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="mt-2 text-xs text-red-600 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Lupa Password -->
                                <div class="text-left">
                                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                        Lupa Password?
                                    </a>
                                </div>

                                <!-- Checkbox Privacy -->
                                <div class="flex items-start gap-2 py-2">
                                    <input type="checkbox" id="agree" required
                                        class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="agree" class="text-xs text-gray-600 leading-relaxed">
                                        Dengan login menggunakan nomor atau metode lain, saya setuju dengan
                                        <a href="#" class="text-blue-600 hover:underline">Ketentuan Pengguna</a> &
                                        <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="w-full py-4 bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-300 shadow-lg hover:shadow-xl active:scale-[0.98]">
                                    LOGIN
                                </button>
                            </form>

                            <!-- Footer -->
                            <div class="mt-6 text-center">
                                <p class="text-xs text-gray-500">
                                    &copy; 2025 Sewa Aja. Made with
                                    <i class="fas fa-heart text-red-500"></i> by
                                    <span
                                        class="font-bold text-lg bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">𝓟 .</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Form submission loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = this.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
        });
    </script>
</body>

</html>
