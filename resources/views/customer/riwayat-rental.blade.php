@extends('layouts.user')

@section('title', 'Riwayat Sewa')

@section('content')
    <div class="py-6">
        <!-- Filter Tabs -->
        <div class="flex bg-gray-100 rounded-2xl p-1 mb-6">
            <button class="flex-1 py-2 px-3 rounded-xl text-sm font-medium bg-white text-blue-600 shadow-sm">
                Semua
            </button>
            <button class="flex-1 py-2 px-3 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-800">
                Berlangsung
            </button>
            <button class="flex-1 py-2 px-3 rounded-xl text-sm font-medium text-gray-600 hover:text-gray-800">
                Selesai
            </button>
        </div>

        <!-- Rental History -->
        <div class="space-y-4">
            @foreach ($rentals as $rental)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4">
                    <!-- Header -->
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $rental->kendaraan->nama_kendaraan }}</h3>
                            <p class="text-sm text-gray-600">{{ $rental->kendaraan->merek }}</p>
                        </div>
                        <span
                            class="px-3 py-1 rounded-full text-xs font-medium 
                    {{ $rental->status_sewa == 'pending' ? 'bg-yellow-100 text-yellow-600' : '' }}
                    {{ $rental->status_sewa == 'dipinjam' ? 'bg-blue-100 text-blue-600' : '' }}
                    {{ $rental->status_sewa == 'selesai' ? 'bg-green-100 text-green-600' : '' }}
                    {{ $rental->status_sewa == 'dibatalkan' ? 'bg-red-100 text-red-600' : '' }}">
                            {{ ucfirst($rental->status_sewa) }}
                        </span>
                    </div>

                    <!-- Rental Period -->
                    <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                        <i class="fas fa-calendar"></i>
                        <span>{{ \Carbon\Carbon::parse($rental->tanggal_mulai)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($rental->tanggal_selesai)->format('d M Y') }}</span>
                    </div>

                    <!-- Price -->
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-600">Total Biaya</span>
                        <span class="font-bold text-blue-600">Rp
                            {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2">
                        @if ($rental->status_sewa == 'pending')
                            <a href="{{ route('user.payment', $rental->id) }}"
                                class="flex-1 bg-blue-600 text-white text-center py-2 rounded-xl text-sm font-medium hover:bg-blue-700 active:scale-95 transition-all">
                                Bayar
                            </a>
                            <button
                                class="flex-1 bg-gray-100 text-gray-700 text-center py-2 rounded-xl text-sm font-medium hover:bg-gray-200 active:scale-95 transition-all">
                                Batalkan
                            </button>
                        @elseif($rental->status_sewa == 'dipinjam')
                            <button
                                class="flex-1 bg-green-600 text-white text-center py-2 rounded-xl text-sm font-medium hover:bg-green-700 active:scale-95 transition-all">
                                Kembalikan
                            </button>
                        @else
                            <button
                                class="flex-1 bg-gray-100 text-gray-700 text-center py-2 rounded-xl text-sm font-medium hover:bg-gray-200 active:scale-95 transition-all">
                                Detail
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach

            @if ($rentals->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-history text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada riwayat penyewaan</p>
                    <a href="{{ route('user.products') }}"
                        class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 active:scale-95 transition-all">
                        Sewa Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
