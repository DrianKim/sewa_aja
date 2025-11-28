    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Sewa Aja</title>

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

            .login-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 24px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                width: 100%;
                max-width: 440px;
                padding: 50px 40px;
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
                margin-bottom: 0.8rem;
            }

            .logo-icon {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
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
                font-size: 40px;
                color: white;
            }

            .logo-section h1 {
                font-size: 32px;
                font-weight: 700;
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                margin-bottom: 8px;
            }

            .logo-section p {
                color: #666;
                font-size: 14px;
            }

            .form-group {
                margin-bottom: 25px;
                position: relative;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                color: #333;
                font-weight: 600;
                font-size: 14px;
            }

            .input-wrapper {
                position: relative;
            }

            .input-wrapper i {
                position: absolute;
                left: 18px;
                top: 50%;
                transform: translateY(-50%);
                color: #3b82f6;
                font-size: 18px;
            }

            .form-control {
                width: 100%;
                padding: 15px 15px 15px 50px;
                border: 2px solid #e0e0e0;
                border-radius: 12px;
                font-size: 15px;
                transition: all 0.3s ease;
                background: #f8f9fa;
            }

            .form-control:focus {
                outline: none;
                border-color: #3b82f6;
                background: white;
                box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            }

            .password-toggle {
                position: absolute;
                right: 18px;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
                color: #999;
                transition: color 0.3s;
            }

            .password-toggle:hover {
                color: #3b82f6;
            }

            .remember-forgot {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 25px;
                font-size: 14px;
            }

            .remember-me {
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .remember-me input[type="checkbox"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
                accent-color: #3b82f6;
            }

            .forgot-link {
                color: #3b82f6;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s;
            }

            .forgot-link:hover {
                color: #1e40af;
            }

            .btn-login {
                width: 100%;
                padding: 16px;
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                border: none;
                border-radius: 12px;
                color: white;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }

            .btn-login:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(59, 130, 246, 0.6);
            }

            .btn-login:active {
                transform: translateY(0);
            }

            .divider {
                text-align: center;
                margin: 30px 0;
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
                padding: 0 15px;
                color: #999;
                font-size: 14px;
                position: relative;
                z-index: 1;
            }

            .register-link {
                margin-top: 20px;
                text-align: center;
                color: #666;
                font-size: 14px;
            }

            .register-link a {
                color: #3b82f6;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s;
            }

            .register-link a:hover {
                color: #1e40af;
            }

            .vehicle-icons {
                position: absolute;
                font-size: 30px;
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
                    transform: translateY(-20px) rotate(5deg);
                }
            }

            .error-message {
                color: #dc2626;
                font-size: 12px;
                margin-top: 5px;
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .alert {
                padding: 12px 16px;
                border-radius: 12px;
                margin-bottom: 20px;
                text-align: center;
                font-weight: 500;
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

            @media (max-width: 480px) {
                .login-container {
                    padding: 40px 30px;
                }

                .logo-section h1 {
                    font-size: 28px;
                }
            }

            .copyright-simple {
                text-align: center;
                margin-top: 15px;
                padding-top: 10px;
                border-top: 1px solid #e5e7eb;
                color: #6b7280;
                font-size: 11px;
            }
        </style>
    </head>

    <body>
        <i class="fas fa-car vehicle-icons"></i>
        <i class="fas fa-motorcycle vehicle-icons"></i>
        <i class="fas fa-bicycle vehicle-icons"></i>

        <div class="login-container">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-car-side"></i>
                </div>
                <h1>Sewa Aja</h1>
                <p>Rental Kendaraan Terpercaya</p>
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

            <form method="POST" action="{{ route('login.proses') }}">
                @csrf
                <div class="form-group">
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

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') error-border @enderror" placeholder="Masukkan password"
                            required>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>

            <div class="copyright-simple">
                <p>&copy; 2025 Sewa Aja. Made with <i class="fas fa-heart" style="color: #dc2626;"></i> by 𝓟</p>
                {{-- <p>&copy; 2025 SewaAja. All rights reserved.</p>
                <span class="text-base font-bold text-gray-500">Made With</span>
                <span class="mx-1 text-xl text-gray-400"><i class="fas fa-heart"></i></span>
                <span class="text-base font-bold text-gray-700">By</span>
                <a href="#"><span class="text-xl font-bold text-blue-500">𝓟</span></a> --}}
            </div>
        </div>

        <script>
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }

            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

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
