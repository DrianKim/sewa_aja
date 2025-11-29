@extends('admin.layouts.app')
@section('title', 'Edit Harga - Sewa Aja')

@section('content')
    <div class="container px-6 py-8 mx-auto">
        <div class="overflow-hidden bg-white shadow-lg rounded-xl">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-amber-100 bg-gradient-to-r from-amber-500 to-amber-600">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-12 h-12 mr-4 bg-white shadow-md rounded-xl">
                        <i class="text-xl text-amber-600 fas fa-edit"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit Harga Kendaraan</h2>
                        <p class="mt-1 text-sm text-amber-100">Perbarui informasi harga kendaraan</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('harga.update', $harga->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <!-- Info Box -->
                <div class="p-4 mb-6 border-l-4 rounded-r-lg border-amber-500 bg-amber-50">
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 text-amber-600 fas fa-info-circle"></i>
                        <div>
                            <p class="text-sm font-medium text-amber-800">Informasi</p>
                            <p class="text-sm text-amber-700">
                                Anda sedang mengedit harga untuk:
                                <strong>{{ $harga->kendaraan->merek }} {{ $harga->kendaraan->nama_kendaraan }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kendaraan Dropdown -->
                <div class="mb-6">
                    <label for="id_kendaraan" class="block mb-2 text-sm font-semibold text-gray-700">
                        Pilih Kendaraan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="text-gray-400 fas fa-car"></i>
                        </div>
                        <select id="id_kendaraan_display"
                            class="block w-full py-3 pl-12 pr-10 text-gray-500 bg-gray-100 cursor-not-allowed border border-gray-300 rounded-lg"
                            disabled>
                            @foreach ($kendaraans as $kendaraan)
                                <option value="{{ $kendaraan->id }}"
                                    {{ old('id_kendaraan', $harga->id_kendaraan) == $kendaraan->id ? 'selected' : '' }}>
                                    {{ $kendaraan->merek }} {{ $kendaraan->nama_kendaraan }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Hidden input agar value tetap terkirim -->
                        <input type="hidden" name="id_kendaraan" value="{{ old('id_kendaraan', $harga->id_kendaraan) }}">
                    </div>
                    @error('id_kendaraan')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Kategori & Jenis (Auto Display) -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <!-- Kategori -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Kategori
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-folder"></i>
                            </div>
                            <input type="text" id="display_kategori" readonly
                                class="block w-full py-3 pl-12 pr-4 text-gray-500 bg-gray-100 border border-gray-300 rounded-lg"
                                placeholder="Akan terisi otomatis"
                                value="{{ $harga->kendaraan->kategori->nama_kategori ?? '-' }}">
                        </div>
                    </div>

                    <!-- Jenis -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Jenis
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-list"></i>
                            </div>
                            <input type="text" id="display_jenis" readonly
                                class="block w-full py-3 pl-12 pr-4 text-gray-500 bg-gray-100 border border-gray-300 rounded-lg"
                                placeholder="Akan terisi otomatis" value="{{ $harga->kendaraan->kategori->jenis ?? '-' }}">
                        </div>
                    </div>
                </div>

                <!-- Harga Perhari -->
                <div class="mb-6">
                    <label for="harga_perhari" class="block mb-2 text-sm font-semibold text-gray-700">
                        Harga Perhari <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="text-gray-400 fas fa-money-bill-wave"></i>
                        </div>
                        <input type="number" name="harga_perhari" id="harga_perhari" required min="0"
                            class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400 @error('harga_perhari') border-red-500 @enderror"
                            placeholder="Contoh: 150000" value="{{ old('harga_perhari', $harga->harga_perhari) }}">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-500">/hari</span>
                        </div>
                    </div>
                    @error('harga_perhari')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tanggal Berlaku -->
                <div class="mb-6">
                    <label for="tanggal_berlaku" class="block mb-2 text-sm font-semibold text-gray-700">
                        Tanggal Berlaku <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="text-gray-400 fas fa-calendar-alt"></i>
                        </div>
                        <input type="date" name="tanggal_berlaku" id="tanggal_berlaku" required
                            class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400 @error('tanggal_berlaku') border-red-500 @enderror"
                            value="{{ old('tanggal_berlaku', $harga->tanggal_berlaku) }}">
                    </div>
                    @error('tanggal_berlaku')
                        <p class="mt-2 text-sm text-red-600">
                            <i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="mr-1 fas fa-info-circle"></i>
                        Tanggal ketika harga ini mulai berlaku
                    </p>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end pt-8 space-x-4 border-t border-amber-100">
                    <a href="{{ route('harga.index') }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 hover:shadow-md">
                        <i class="mr-2 fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3.5 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl shadow-lg hover:from-amber-600 hover:to-amber-700 hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                        <i class="mr-2 fas fa-save"></i>
                        Update Harga
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kendaraanSelect = document.getElementById('id_kendaraan');
            const displayKategori = document.getElementById('display_kategori');
            const displayJenis = document.getElementById('display_jenis');

            // Handle kendaraan selection change
            kendaraanSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];

                if (selectedOption.value) {
                    const kategori = selectedOption.getAttribute('data-kategori');
                    const jenis = selectedOption.getAttribute('data-jenis');

                    displayKategori.value = kategori;
                    displayJenis.value = jenis;
                } else {
                    displayKategori.value = '';
                    displayJenis.value = '';
                }
            });

            // Format harga input
            const hargaInput = document.getElementById('harga_perhari');
            hargaInput.addEventListener('input', function() {
                // Remove any non-numeric characters
                this.value = this.value.replace(/[^0-9]/g, '');
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
        select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
    </style>
@endsection
