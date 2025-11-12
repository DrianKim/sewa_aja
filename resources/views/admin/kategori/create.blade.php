@extends('admin.layouts.app')
@section('title', 'Kategori')

@section('content')
<div class="container px-6 py-1 mx-auto">
    <!-- Back Button -->
    {{-- <div class="mb-6">
        <a href="{{ route('kategori.index') }}"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 hover:border-gray-400 hover:shadow-md">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div> --}}

    <div class="overflow-hidden bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
            <div class="flex items-center">
                <div class="flex items-center justify-center w-10 h-10 mr-4 bg-white rounded-lg shadow-md">
                    <i class="text-lg text-blue-600 fas fa-plus-circle"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">Tambah Kategori Baru</h2>
                    <p class="text-sm text-blue-100">Isi form di bawah untuk menambahkan kategori kendaraan</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('kategori.store') }}" method="POST" class="p-8">
            @csrf

            <!-- Nama Kategori -->
            <div class="mb-6">
                <label for="nama" class="block mb-2 text-sm font-semibold text-gray-700">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <i class="text-gray-400 fas fa-tag"></i>
                    </div>
                    <input type="text" name="nama" id="nama" required
                        class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400 @error('nama') border-red-500 @enderror"
                        placeholder="Contoh: Motor, Mobil, Bus, dll"
                        value="{{ old('nama') }}">
                </div>
                @error('nama')
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
            <div class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200">
                <a href="{{ route('kategori.index') }}"
                    class="inline-flex items-center px-6 py-3 text-sm font-semibold text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 hover:shadow-md">
                    <i class="mr-2 fas fa-times"></i>
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md hover:from-blue-600 hover:to-blue-700 hover:shadow-lg transform hover:-translate-y-0.5">
                    <i class="mr-2 fas fa-save"></i>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
