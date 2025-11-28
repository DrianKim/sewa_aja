<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sewa Aja</title>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -250px;
            right: -250px;
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            bottom: -200px;
            left: -200px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(20px);
            }
        }

        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 440px;
            padding: 35px 30px;
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 1.2rem;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            box-shadow: 0 6px 15px rgba(59, 130, 246, 0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .logo-icon i {
            font-size: 26px;
            color: white;
        }

        .logo-section h1 {
            font-size: 24px;
            font-weight: 700;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 6px;
        }

        .logo-section p {
            color: #666;
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 16px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #333;
            font-weight: 600;
            font-size: 13px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #3b82f6;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 13px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            transition: color 0.3s;
            font-size: 14px;
        }

        .password-toggle:hover {
            color: #3b82f6;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 8px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(59, 130, 246, 0.6);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: #e0e0e0;
        }

        .divider span {
            background: white;
            padding: 0 12px;
            color: #999;
            font-size: 13px;
            position: relative;
            z-index: 1;
        }

        .login-link {
            text-align: center;
            color: #666;
            font-size: 13px;
        }

        .login-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #1e40af;
        }

        .vehicle-icons {
            position: absolute;
            font-size: 25px;
            opacity: 0.1;
            animation: floatVehicle 10s ease-in-out infinite;
        }

        .vehicle-icons:nth-child(1) {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .vehicle-icons:nth-child(2) {
            top: 60%;
            right: 8%;
            animation-delay: 2s;
        }

        .vehicle-icons:nth-child(3) {
            bottom: 15%;
            left: 10%;
            animation-delay: 4s;
        }

        @keyframes floatVehicle {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(5deg);
            }
        }

        .error-message {
            color: #dc2626;
            font-size: 11px;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .alert {
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 16px;
            text-align: center;
            font-weight: 500;
            font-size: 13px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .copyright-simple {
            text-align: center;
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 10px;
        }

        .terms-text {
            font-size: 11px;
            color: #666;
            text-align: center;
            margin-top: 12px;
            line-height: 1.4;
        }

        .terms-text a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 11px;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 25px 20px;
                max-width: 100%;
            }

            .logo-section h1 {
                font-size: 22px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            body {
                padding: 15px;
            }
        }

        /* Compact textarea */
        textarea.form-control {
            resize: vertical;
            min-height: 70px;
            font-size: 13px;
        }

        /* Compact spacing untuk form yang panjang */
        .form-compact {
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <i class="fas fa-car vehicle-icons"></i>
    <i class="fas fa-motorcycle vehicle-icons"></i>
    <i class="fas fa-bicycle vehicle-icons"></i>

    <div class="register-container">
        <div class="logo-section">
            <div class="logo-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Daftar Akun</h1>
            <p>Bergabung dengan Sewa Aja</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register.proses') }}">
            @csrf

            <!-- Nama Lengkap -->
            <div class="form-group form-compact">
                <label for="nama">Nama Lengkap</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" id="nama" name="nama"
                        class="form-control @error('nama') error-border @enderror" placeholder="Masukkan nama lengkap"
                        value="{{ old('nama') }}" required>
                </div>
                @error('nama')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group form-compact">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') error-border @enderror" placeholder="Masukkan email"
                        value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- No HP dan Password dalam satu baris -->
            <div class="form-row">
                <!-- No HP -->
                <div class="form-group form-compact">
                    <label for="no_hp">No HP</label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="no_hp" name="no_hp"
                            class="form-control @error('no_hp') error-border @enderror" placeholder="0812..."
                            value="{{ old('no_hp') }}" required>
                    </div>
                    @error('no_hp')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group form-compact">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') error-border @enderror" placeholder="Min. 6 karakter"
                            required>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Alamat -->
            <div class="form-group form-compact">
                <label for="alamat">Alamat</label>
                <div class="input-wrapper">
                    <i class="fas fa-map-marker-alt"></i>
                    <textarea id="alamat" name="alamat" rows="2" class="form-control @error('alamat') error-border @enderror"
                        placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                </div>
                @error('alamat')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-group form-compact">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Ulangi password" required>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="terms-text">
                Dengan mendaftar, Anda menyetujui
                <a href="#">Syarat & Ketentuan</a> dan
                <a href="#">Kebijakan Privasi</a> kami.
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>

        <div class="copyright-simple">
            <p>&copy; 2025 Sewa Aja. Made with <i class="fas fa-heart" style="color: #dc2626;"></i> by 𝓟</p>
        </div>
    </div>

    <script>
        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const passwordConfirmationInput = document.getElementById('password_confirmation');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        if (togglePasswordConfirmation && passwordConfirmationInput) {
            togglePasswordConfirmation.addEventListener('click', function() {
                const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmationInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        // Input focus effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Real-time password validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.style.borderColor = '#dc2626';
                confirmPassword.style.background = '#fef2f2';
            } else {
                confirmPassword.style.borderColor = '#3b82f6';
                confirmPassword.style.background = '#f0f9ff';
            }
        }

        if (password && confirmPassword) {
            password.addEventListener('input', validatePassword);
            confirmPassword.addEventListener('input', validatePassword);
        }

        // Add error border style
        const style = document.createElement('style');
        style.textContent = `
            .error-border {
                border-color: #dc2626 !important;
                background: #fef2f2 !important;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>

</html>
