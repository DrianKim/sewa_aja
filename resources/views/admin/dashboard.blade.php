@extends('admin.layouts.app')
@section('title', 'Dashboard Admin - Sewa Aja')

@section('content')
    <div class="px-6 py-8 space-y-8">
        <!-- Stats Cards Row 1 -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Kendaraan -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-600">Total Kendaraan</p>
                        <p class="mt-2 text-3xl font-bold text-blue-900">{{ $totalKendaraan ?? 0 }}</p>
                        <p class="mt-1 text-xs text-blue-600">Semua kategori</p>
                    </div>
                    <div class="flex items-center justify-center w-16 h-16 rounded-xl bg-blue-200/50">
                        <i class="text-3xl text-blue-600 fas fa-car-side"></i>
                    </div>
                </div>
            </div>

            <!-- Kendaraan Tersedia -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-green-50 to-green-100 border border-green-200 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-600">Kendaraan Tersedia</p>
                        <p class="mt-2 text-3xl font-bold text-green-900">{{ $kendaraanTersedia ?? 0 }}</p>
                        <p class="mt-1 text-xs text-green-600">Siap disewa</p>
                    </div>
                    <div class="flex items-center justify-center w-16 h-16 rounded-xl bg-green-200/50">
                        <i class="text-3xl text-green-600 fas fa-check-circle"></i>
                    </div>
                </div>
            </div>

            <!-- Rental Aktif -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-600">Rental Aktif</p>
                        <p class="mt-2 text-3xl font-bold text-purple-900">{{ $rentalAktif ?? 0 }}</p>
                        <p class="mt-1 text-xs text-purple-600">Sedang disewa</p>
                    </div>
                    <div class="flex items-center justify-center w-16 h-16 rounded-xl bg-purple-200/50">
                        <i class="text-3xl text-purple-600 fas fa-handshake"></i>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-amber-50 to-amber-100 border border-amber-200 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-amber-600">Total Revenue</p>
                        <p class="mt-2 text-3xl font-bold text-amber-900">Rp
                            {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                        <p class="mt-1 text-xs text-amber-600">Bulan ini</p>
                    </div>
                    <div class="flex items-center justify-center w-16 h-16 rounded-xl bg-amber-200/50">
                        <i class="text-3xl text-amber-600 fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Row 2 -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Pembayaran Tertunda -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-red-50 to-red-100 border border-red-200 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-red-600">Pembayaran Tertunda</p>
                        <p class="mt-2 text-3xl font-bold text-red-900">{{ $pembayaranTertunda ?? 0 }}</p>
                        <p class="mt-1 text-xs text-red-600">Perlu ditindaklanjuti</p>
                    </div>
                    <div class="flex items-center justify-center w-16 h-16 rounded-xl bg-red-200/50">
                        <i class="text-3xl text-red-600 fas fa-exclamation-circle"></i>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-cyan-50 to-cyan-100 border border-cyan-200 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-cyan-600">Total Users</p>
                        <p class="mt-2 text-3xl font-bold text-cyan-900">{{ $totalUsers ?? 0 }}</p>
                        <p class="mt-1 text-xs text-cyan-600">Pengguna aktif</p>
                    </div>
                    <div class="flex items-center justify-center w-16 h-16 rounded-xl bg-cyan-200/50">
                        <i class="text-3xl text-cyan-600 fas fa-users"></i>
                    </div>
                </div>
            </div>

            <!-- Kategori Populer -->
            <div
                class="p-6 rounded-xl shadow-lg bg-gradient-to-br from-pink-50 to-pink-100 border border-pink-200 hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-pink-600">Kategori Populer</p>
                        <p class="mt-2 text-3xl font-bold text-pink-900">{{ $kategoriPopuler ?? '-' }}</p>
                        <p class="mt-1 text-xs text-pink-600">Paling sering disewa</p>
                    </div>
                    <div class="flex items-center justify-center w-16 h-16 rounded-xl bg-pink-200/50">
                        <i class="text-3xl text-pink-600 fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Revenue Chart -->
            <div class="p-6 rounded-xl shadow-lg bg-white border border-gray-200">
                <h3 class="mb-4 text-lg font-bold text-gray-800 flex items-center">
                    <i class="mr-2 text-blue-600 fas fa-chart-line"></i>
                    Revenue Bulanan
                </h3>
                <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                    <p class="text-gray-500">Grafik revenue akan ditampilkan di sini</p>
                </div>
            </div>

            <!-- Status Kendaraan -->
            <div class="p-6 rounded-xl shadow-lg bg-white border border-gray-200">
                <h3 class="mb-4 text-lg font-bold text-gray-800 flex items-center">
                    <i class="mr-2 text-purple-600 fas fa-chart-pie"></i>
                    Status Kendaraan
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Tersedia</span>
                        </div>
                        <span class="font-bold text-gray-800">{{ $kendaraanTersedia ?? 0 }}
                            ({{ $persentaseTersedia ?? 0 }}%)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Disewa</span>
                        </div>
                        <span class="font-bold text-gray-800">{{ $kendaraanDisewa ?? 0 }}
                            ({{ $persentaseDisewa ?? 0 }}%)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Perbaikan</span>
                        </div>
                        <span class="font-bold text-gray-800">{{ $kendaraanPerbaikan ?? 0 }}
                            ({{ $persentasePerbaikan ?? 0 }}%)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Rentals & Pending Payments -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent Rentals -->
            <div class="p-6 rounded-xl shadow-lg bg-white border border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="mr-2 text-blue-600 fas fa-history"></i>
                        Rental Terbaru
                    </h3>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @if (isset($rentalTerbaru) && count($rentalTerbaru) > 0)
                        @foreach ($rentalTerbaru as $rental)
                            <div
                                class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $rental->user->nama ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">{{ $rental->kendaraan->merek ?? 'N/A' }}
                                        {{ $rental->kendaraan->nama_kendaraan ?? 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-800">Rp
                                        {{ number_format($rental->total_harga ?? 0, 0, ',', '.') }}</p>
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $rental->status_sewa == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $rental->status_sewa ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500 py-6">Tidak ada rental terbaru</p>
                    @endif
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="p-6 rounded-xl shadow-lg bg-white border border-gray-200">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="mr-2 text-red-600 fas fa-clock"></i>
                        Pembayaran Tertunda
                    </h3>
                    <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat Semua</a>
                </div>
                <div class="space-y-3">
                    @if (isset($pembayaranTertundaList) && count($pembayaranTertundaList) > 0)
                        @foreach ($pembayaranTertundaList as $pembayaran)
                            <div
                                class="flex items-center justify-between p-3 border border-red-200 rounded-lg bg-red-50 hover:bg-red-100 transition">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $pembayaran->rental->user->nama ?? 'N/A' }}
                                    </p>
                                    <p class="text-sm text-gray-600">Jatuh tempo:
                                        {{ isset($pembayaran->rental->tanggal_selesai) ? date('d M Y', strtotime($pembayaran->rental->tanggal_selesai)) : 'N/A' }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-red-600">Rp
                                        {{ number_format($pembayaran->rental->total_harga ?? 0, 0, ',', '.') }}</p>
                                    <button
                                        class="mt-1 px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-700 transition">
                                        Tindakan
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500 py-6">Tidak ada pembayaran tertunda</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="p-6 rounded-xl shadow-lg bg-gradient-to-r from-blue-600 to-blue-700 border border-blue-400">
            <h3 class="mb-4 text-lg font-bold text-white flex items-center">
                <i class="mr-2 fas fa-lightning-bolt"></i>
                Quick Actions
            </h3>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <a href="{{ route('kendaraan.create') }}"
                    class="p-4 text-center rounded-lg bg-white/20 hover:bg-white/30 transition text-white font-semibold">
                    <i class="block text-2xl mb-2 fas fa-plus-circle"></i>
                    Tambah Kendaraan
                </a>
                <a href="{{ route('harga.index') }}"
                    class="p-4 text-center rounded-lg bg-white/20 hover:bg-white/30 transition text-white font-semibold">
                    <i class="block text-2xl mb-2 fas fa-tag"></i>
                    Atur Harga
                </a>
                <a href="#"
                    class="p-4 text-center rounded-lg bg-white/20 hover:bg-white/30 transition text-white font-semibold">
                    <i class="block text-2xl mb-2 fas fa-print"></i>
                    Cetak Laporan
                </a>
                <a href="#"
                    class="p-4 text-center rounded-lg bg-white/20 hover:bg-white/30 transition text-white font-semibold">
                    <i class="block text-2xl mb-2 fas fa-envelope"></i>
                    Kirim Notifikasi
                </a>
            </div>
        </div>
    </div>

    <script>
        // Animasi angka counter
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 60;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 16);
        }

        // Trigger animation saat page load
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.text-3xl.font-bold').forEach(el => {
                const text = el.textContent.trim();
                const num = parseInt(text);
                if (!isNaN(num)) {
                    el.textContent = '0';
                    animateCounter(el, num);
                }
            });
        });
    </script>
@endsection
