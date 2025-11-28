@extends('admin.layouts.app')
@section('title', 'Tambah Kategori - Sewa Aja')

@section('content')
    <div class="container px-6 py-8 mx-auto">
        <div class="overflow-hidden bg-white shadow-lg rounded-xl">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-blue-100 bg-gradient-to-r from-blue-600 to-blue-700">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-12 h-12 mr-4 bg-white shadow-md rounded-xl">
                        <i class="text-xl text-blue-600 fas fa-plus-circle"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Tambah Kategori Baru</h2>
                        <p class="mt-1 text-sm text-blue-100">Isi form di bawah untuk menambahkan kategori kendaraan</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('kategori.store') }}" method="POST" class="p-8">
                @csrf

                <!-- Nama Kategori -->
                <div class="mb-6">
                    <label for="nama_kategori" class="block mb-2 text-sm font-semibold text-gray-700">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="text-gray-400 fas fa-tag"></i>
                        </div>
                        <input type="text" name="nama_kategori" id="nama_kategori" required
                            class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('nama_kategori') border-red-500 @enderror"
                            placeholder="Contoh: Motor, Mobil, Bus, dll" value="{{ old('nama_kategori') }}">
                    </div>
                    @error('nama_kategori')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Jenis -->
                <div class="mb-6">
                    <label for="jenis" class="block mb-2 text-sm font-semibold text-gray-700">
                        Jenis <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="text-gray-400 fas fa-list"></i>
                        </div>
                        <input type="text" name="jenis" id="jenis" required
                            class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('jenis') border-red-500 @enderror"
                            placeholder="Contoh: Sepeda Motor, Mobil Pribadi, Bus Pariwisata, dll"
                            value="{{ old('jenis') }}">
                    </div>
                    @error('jenis')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end pt-8 space-x-4 border-t border-blue-100">
                    <a href="{{ route('kategori.index') }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-blue-700 transition-all duration-200 bg-white border-2 border-blue-200 rounded-xl hover:bg-blue-50 hover:border-blue-300 hover:shadow-md transform hover:-translate-y-0.5">
                        <i class="mr-2 fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3.5 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                        <i class="mr-2 fas fa-save"></i>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- <style>
        .rounded-xl {
            border-radius: 12px;
        }

        .shadow-lg {
            box-shadow: 0 10px 25px -3px rgba(59, 130, 246, 0.1), 0 4px 6px -2px rgba(59, 130, 246, 0.05);
        }

        .hover\:shadow-md:hover {
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1), 0 4px 6px -2px rgba(59, 130, 246, 0.05);
        }

        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }

        /* Custom focus styles */
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add animation to form elements
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('transform', 'scale-105');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('transform', 'scale-105');
                });
            });

            // Success message handler
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#3b82f6',
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
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'animated fadeInDown faster'
                    }
                });
            @endif
        });
    </script> --}}
@endsection
