@extends('customer.layouts.app')

@section('title', 'Sewa Kendaraan')

@section('content')
    <div class="py-6">
        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative">
                <input type="text" placeholder="Cari kendaraan..."
                    class="w-full input-mobile pl-12 pr-4 bg-white border border-gray-300 rounded-2xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="mb-6 overflow-x-auto">
            <div class="flex space-x-3 pb-2">
                <button class="flex-shrink-0 px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-medium">
                    Semua
                </button>
                @foreach ($kategori as $k)
                    <button
                        class="flex-shrink-0 px-4 py-2 bg-white border border-gray-300 rounded-full text-sm font-medium text-gray-700 hover:bg-gray-50">
                        {{ $k->nama_kategori }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-2 gap-4">
            @foreach ($kendaraan as $k)
                <a href="{{ route('user.products.detail', $k->id) }}"
                    class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow active:scale-95">
                    <!-- Vehicle Image -->
                    <div class="aspect-w-16 aspect-h-12 bg-gray-100">
                        <img src="{{ asset('storage/' . $k->foto) }}" alt="{{ $k->nama_kendaraan }}"
                            class="w-full h-32 object-cover">
                    </div>

                    <!-- Vehicle Info -->
                    <div class="p-3">
                        <h3 class="font-semibold text-gray-800 text-sm mb-1">{{ $k->nama_kendaraan }}</h3>
                        <p class="text-xs text-gray-600 mb-2">{{ $k->merek }}</p>

                        <!-- Price -->
                        <div class="flex items-center justify-between">
                            <span class="text-blue-600 font-bold text-sm">
                                Rp {{ number_format($k->harga->first()->harga_perhari, 0, ',', '.') }}/hari
                            </span>
                            <span
                                class="text-xs px-2 py-1 rounded-full {{ $k->status == 'tersedia' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $k->status }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Load More -->
        <div class="mt-8 text-center">
            <button
                class="btn-mobile bg-white border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 active:scale-95 transition-all font-medium">
                Muat Lebih Banyak
            </button>
        </div>
    </div>
@endsection
