@extends('layouts.user')

@section('title', 'Form Sewa')

@section('back-button')
    <a href="{{ route('user.products.detail', $kendaraan->id) }}"
        class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 active:scale-95 transition-all">
        <i class="fas fa-arrow-left text-gray-600"></i>
    </a>
@endsection

@section('content')
    <div class="py-4">
        <!-- Vehicle Summary -->
        <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
            <div class="flex gap-4">
                <img src="{{ asset('storage/' . $kendaraan->foto) }}" alt="{{ $kendaraan->nama_kendaraan }}"
                    class="w-20 h-20 object-cover rounded-xl">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">{{ $kendaraan->nama_kendaraan }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $kendaraan->merek }}</p>
                    <p class="text-blue-600 font-bold">
                        Rp {{ number_format($kendaraan->harga->first()->harga_perhari, 0, ',', '.') }}/hari
                    </p>
                </div>
            </div>
        </div>

        <!-- Rental Form -->
        <form action="{{ route('user.rent.store') }}" method="POST" id="rentalForm">
            @csrf
            <input type="hidden" name="id_kendaraan" value="{{ $kendaraan->id }}">

            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-4">Detail Penyewaan</h3>

                <!-- Tanggal Mulai -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" min="{{ date('Y-m-d') }}"
                        class="w-full input-mobile px-4 bg-gray-50 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                        required>
                    @error('tanggal_mulai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Selesai -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" min="{{ date('Y-m-d') }}"
                        class="w-full input-mobile px-4 bg-gray-50 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                        required>
                    @error('tanggal_selesai')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration & Price Calculation -->
                <div class="bg-blue-50 rounded-xl p-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">Lama Sewa:</span>
                        <span id="duration" class="font-semibold">0 hari</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Biaya:</span>
                        <span id="total_price" class="text-lg font-bold text-blue-600">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                <h3 class="font-semibold text-gray-800 mb-4">Info Kontak</h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                    <input type="tel" name="no_hp" value="{{ auth()->user()->no_hp }}"
                        class="w-full input-mobile px-4 bg-gray-50 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Penjemputan</label>
                    <textarea name="alamat_jemput" rows="3"
                        class="w-full input-mobile px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                        placeholder="Masukkan alamat lengkap untuk penjemputan kendaraan" required>{{ auth()->user()->alamat }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="sticky bottom-20 bg-white border-t border-gray-200 p-4 -mx-4 mt-6">
                <button type="submit"
                    class="w-full btn-mobile bg-gradient-to-r from-blue-600 to-blue-500 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-blue-600 active:scale-95 transition-all shadow-lg">
                    Lanjutkan Pembayaran
                </button>
            </div>
        </form>
    </div>

    <script>
        // Price calculation
        const pricePerDay = {{ $kendaraan->harga->first()->harga_perhari }};
        const startDateInput = document.getElementById('tanggal_mulai');
        const endDateInput = document.getElementById('tanggal_selesai');
        const durationElement = document.getElementById('duration');
        const totalPriceElement = document.getElementById('total_price');

        function calculatePrice() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (startDate && endDate && endDate > startDate) {
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const totalPrice = diffDays * pricePerDay;

                durationElement.textContent = `${diffDays} hari`;
                totalPriceElement.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
            } else {
                durationElement.textContent = '0 hari';
                totalPriceElement.textContent = 'Rp 0';
            }
        }

        startDateInput.addEventListener('change', calculatePrice);
        endDateInput.addEventListener('change', calculatePrice);

        // Form validation
        document.getElementById('rentalForm').addEventListener('submit', function(e) {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (endDate <= startDate) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Tanggal tidak valid',
                    text: 'Tanggal selesai harus setelah tanggal mulai'
                });
            }
        });
    </script>
@endsection
