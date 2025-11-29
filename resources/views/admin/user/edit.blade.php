@extends('admin.layouts.app')
@section('title', 'Edit User - Sewa Aja')

@section('content')
    <div class="container px-6 py-8 mx-auto">
        <div class="overflow-hidden bg-white shadow-lg rounded-xl">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-amber-100 bg-gradient-to-r from-amber-500 to-amber-600">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-12 h-12 mr-4 bg-white shadow-md rounded-xl">
                        <i class="text-xl text-amber-600 fas fa-user-edit"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit User</h2>
                        <p class="mt-1 text-sm text-amber-100">Perbarui informasi user</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('user.update', $user->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <!-- Informasi Edit -->
                <div class="p-4 mb-8 border-l-4 rounded-r-lg border-amber-500 bg-amber-50">
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 text-amber-600 fas fa-info-circle"></i>
                        <div>
                            <p class="text-sm font-medium text-amber-800">Informasi</p>
                            <p class="text-sm text-amber-700">Anda sedang mengedit user:
                                <strong>{{ $user->nama }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block mb-3 text-sm font-semibold text-gray-700">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-user"></i>
                            </div>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $user->nama) }}"
                                required
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400 @error('nama') border-red-500 @enderror"
                                placeholder="Contoh: Budi Santoso">
                        </div>
                        @error('nama')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-3 text-sm font-semibold text-gray-700">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-envelope"></i>
                            </div>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                required
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400 @error('email') border-red-500 @enderror"
                                placeholder="email@example.com">
                        </div>
                        @error('email')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div>
                        <label for="no_hp" class="block mb-3 text-sm font-semibold text-gray-700">
                            Nomor HP <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-phone"></i>
                            </div>
                            <input type="tel" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                                required
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400 @error('no_hp') border-red-500 @enderror"
                                placeholder="08xxxxxxxxxx">
                        </div>
                        @error('no_hp')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password (Opsional) -->
                    <div>
                        <label for="password" class="block mb-3 text-sm font-semibold text-gray-700">
                            Password <span class="text-xs text-gray-400">(Kosongkan jika tidak ingin diubah)</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="password"
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400 @error('password') border-red-500 @enderror"
                                placeholder="Minimal 6 karakter">
                        </div>
                        @error('password')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password (Opsional) -->
                    <div>
                        <label for="password_confirmation" class="block mb-3 text-sm font-semibold text-gray-700">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-lock"></i>
                            </div>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400"
                                placeholder="Ulangi password">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block mb-3 text-sm font-semibold text-gray-700">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute pointer-events-none top-3 left-3">
                                <i class="text-gray-400 fas fa-map-marker-alt"></i>
                            </div>
                            <textarea name="alamat" id="alamat" rows="3" required
                                class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400 @error('alamat') border-red-500 @enderror"
                                placeholder="Alamat lengkap pengguna...">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>
                        @error('alamat')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end pt-8 space-x-4 border-t border-amber-100">
                    <a href="{{ route('user.index') }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-amber-700 transition-all duration-200 bg-white border-2 border-amber-200 rounded-xl hover:bg-amber-50 hover:border-amber-300 hover:shadow-md transform hover:-translate-y-0.5">
                        <i class="mr-2 fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3.5 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl shadow-lg hover:from-amber-600 hover:to-amber-700 hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                        <i class="mr-2 fas fa-save"></i>
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#f59e0b',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'animated fadeInDown faster'
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#f59e0b',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'animated fadeInDown faster'
                }
            });
        @endif
    </script>

    <style>
        .rounded-xl {
            border-radius: 12px;
        }

        .shadow-lg {
            box-shadow: 0 10px 25px -3px rgba(245, 158, 11, 0.1), 0 4px 6px -2px rgba(245, 158, 11, 0.05);
        }

        .hover\:shadow-md:hover {
            box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.1), 0 4px 6px -2px rgba(245, 158, 11, 0.05);
        }

        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(245, 158, 11, 0.1), 0 10px 10px -5px rgba(245, 158, 11, 0.04);
        }

        /* Custom focus styles */
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
    </style>
@endsection
