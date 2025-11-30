@extends('layouts.user')

@section('title', 'Detail Kendaraan')

@section('back-button')
    <a href="{{ route('user.products') }}"
        class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 active:scale-95 transition-all">
        <i class="fas fa-arrow-left text-gray-600"></i>
    </a>
@endsection

@section('content')
    <div class="py-4">
        <!-- Image Gallery -->
        <div class="mb-6">
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <img src="{{ asset('storage/' . $kendaraan->foto) }}" alt="{{ $kendaraan->nama_kendaraan }}"
                    class="w-full h-64 object-cover">
            </div>
        </div>

        <!-- Vehicle Info -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $kendaraan->nama_kendaraan }}</h1>
            <p class="text-gray-600 mb-4">{{ $kendaraan->merek }} • {{ $kendaraan->kategori->nama_kategori }}</p>

            <!-- Status Badge -->
            <div
                class="inline-block px-4 py-2 rounded-full {{ $kendaraan->status == 'tersedia' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} font-medium mb-4">
                {{ ucfirst($kendaraan->status) }}
            </div>

            <!-- Price -->
            <div class="mb-6">
                <span class="text-3xl font-bold text-blue-600">
                    Rp {{ number_format($kendaraan->harga->first()->harga_perhari, 0, ',', '.') }}
                </span>
                <span class="text-gray-600">/hari</span>
            </div>

            <!-- Description -->
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Deskripsi</h3>
                <p class="text-gray-600 leading-relaxed">{{ $kendaraan->deskripsi }}</p>
            </div>
        </div>

        <!-- Features -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h3 class="font-semibold text-gray-800 mb-4">Fitur Kendaraan</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center gap-3">
                    <i class="fas fa-users text-blue-600"></i>
                    <span class="text-gray-600">5 Kursi</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-snowflake text-blue-600"></i>
                    <span class="text-gray-600">AC</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-gas-pump text-blue-600"></i>
                    <span class="text-gray-600">Bensin</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-cog text-blue-600"></i>
                    <span class="text-gray-600">Manual</span>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        @if ($kendaraan->status == 'tersedia')
            <div class="sticky bottom-20 bg-white border-t border-gray-200 p-4 -mx-4 mt-6">
                <a href="{{ route('user.rent.form', $kendaraan->id) }}"
                    class="w-full btn-mobile bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-blue-600 active:scale-95 transition-all shadow-lg text-center block">
                    Sewa Sekarang
                </a>
            </div>
        @else
            <div class="sticky bottom-20 bg-white border-t border-gray-200 p-4 -mx-4 mt-6">
                <button disabled
                    class="w-full btn-mobile bg-gray-400 text-white font-semibold rounded-2xl cursor-not-allowed">
                    Tidak Tersedia
                </button>
            </div>
        @endif
    </div>
@endsection
