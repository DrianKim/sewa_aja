@extends('admin.layouts.app')
@section('title', 'Tambah Kendaraan - Sewa Aja')

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
                        <h2 class="text-2xl font-bold text-white">Tambah Kendaraan Baru</h2>
                        <p class="mt-1 text-sm text-blue-100">Isi form di bawah untuk menambahkan kendaraan</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('kendaraan.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <!-- Merek -->
                    <div>
                        <label for="merek" class="block mb-3 text-sm font-semibold text-gray-700">
                            Merek <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-car"></i>
                            </div>
                            <input type="text" name="merek" id="merek" value="{{ old('merek') }}" required
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('merek') border-red-500 @enderror"
                                placeholder="Contoh: Toyota, Honda, Yamaha">
                        </div>
                        @error('merek')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Nama Kendaraan -->
                    <div>
                        <label for="nama_kendaraan" class="block mb-3 text-sm font-semibold text-gray-700">
                            Nama Kendaraan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-car-side"></i>
                            </div>
                            <input type="text" name="nama_kendaraan" id="nama_kendaraan"
                                value="{{ old('nama_kendaraan') }}" required
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('nama_kendaraan') border-red-500 @enderror"
                                placeholder="Contoh: Avanza, Civic, NMAX">
                        </div>
                        @error('nama_kendaraan')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="id_kategori" class="block mb-3 text-sm font-semibold text-gray-700">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-tags"></i>
                            </div>
                            <select name="id_kategori" id="id_kategori" required
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('id_kategori') border-red-500 @enderror">
                                <option value="" selected hidden>Pilih kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->nama_kategori }}">
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('id_kategori')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Jenis -->
                    <div>
                        <label for="jenis" class="block mb-3 text-sm font-semibold text-gray-700">
                            Jenis
                            <span class="text-xs text-gray-400">(Pilih kategori terlebih dahulu)</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-list"></i>
                            </div>
                            <select name="jenis" id="jenis" required
                                class="block w-full py-3.5 pl-12 pr-4 text-gray-900 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('jenis') border-red-500 @enderror">
                                <option value="" selected hidden>Pilih jenis</option>
                            </select>
                        </div>
                        @error('jenis')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Foto Kendaraan -->
                    <div class="md:col-span-2">
                        <label for="foto" class="block mb-3 text-sm font-semibold text-gray-700">
                            Foto Kendaraan
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-camera"></i>
                            </div>
                            <input type="file" name="foto" id="foto" accept="image/*"
                                class="block w-full py-3.5 pl-12 pr-4 text-sm text-gray-600 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('foto') border-red-500 @enderror">
                        </div>
                        @error('foto')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror

                        <!-- Preview Foto -->
                        <div id="previewContainer" class="hidden mt-4">
                            <p class="mb-2 text-sm font-medium text-gray-700">Preview Foto:</p>
                            <img id="previewFoto" src="" alt="Preview Foto"
                                class="object-contain w-full rounded-lg shadow-md max-h-64">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block mb-3 text-sm font-semibold text-gray-700">
                            Deskripsi
                        </label>
                        <div class="relative">
                            <div class="absolute pointer-events-none top-3 left-3">
                                <i class="text-gray-400 fas fa-file-alt"></i>
                            </div>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('deskripsi') border-red-500 @enderror"
                                placeholder="Deskripsi detail tentang kendaraan...">{{ old('deskripsi') }}</textarea>
                        </div>
                        @error('deskripsi')
                            <p class="flex items-center mt-2 text-sm text-red-600">
                                <i class="mr-2 fas fa-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end pt-8 space-x-4 border-t border-blue-100">
                    <a href="{{ route('kendaraan.index') }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-blue-700 transition-all duration-200 bg-white border-2 border-blue-200 rounded-xl hover:bg-blue-50 hover:border-blue-300 hover:shadow-md transform hover:-translate-y-0.5">
                        <i class="mr-2 fas fa-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3.5 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0">
                        <i class="mr-2 fas fa-save"></i>
                        Simpan Kendaraan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('id_kategori').addEventListener('change', function() {
            const kategori = this.value;
            const jenisSelect = document.getElementById('jenis');

            if (!kategori) {
                jenisSelect.innerHTML = '<option value="">Pilih kategori dulu</option>';
                return;
            }

            // Encode kategori untuk handle special characters
            const encodedKategori = encodeURIComponent(kategori);

            fetch(`/admin/kategori/${encodedKategori}/jenis`)
                .then(res => {
                    if (!res.ok) throw new Error('Network error');
                    return res.json();
                })
                .then(data => {
                    jenisSelect.innerHTML = '<option value="">Pilih jenis</option>';
                    data.forEach(j => {
                        jenisSelect.innerHTML += `<option value="${j}">${j}</option>`;
                    });
                })
                .catch((error) => {
                    console.error('Error:', error);
                    jenisSelect.innerHTML = '<option>Error loading data</option>';
                });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Preview foto
            const fotoInput = document.getElementById('foto');
            const previewContainer = document.getElementById('previewContainer');
            const previewFoto = document.getElementById('previewFoto');

            if (fotoInput) {
                fotoInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        previewContainer.classList.add('hidden');
                        previewFoto.src = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        previewFoto.src = ev.target.result;
                        previewContainer.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                });
            }

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
@endsection
