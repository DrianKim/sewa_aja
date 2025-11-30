@extends('layouts.user')

@section('title', 'Pembayaran')

@section('back-button')
    <a href="{{ route('user.history') }}"
        class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 active:scale-95 transition-all">
        <i class="fas fa-arrow-left text-gray-600"></i>
    </a>
@endsection

@section('content')
    <div class="py-4">
        <!-- Payment Summary -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h3 class="font-semibold text-gray-800 mb-4">Ringkasan Pembayaran</h3>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Kendaraan</span>
                    <span class="font-medium">{{ $rental->kendaraan->nama_kendaraan }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Periode Sewa</span>
                    <span class="font-medium">{{ \Carbon\Carbon::parse($rental->tanggal_mulai)->format('d M Y') }} -
                        {{ \Carbon\Carbon::parse($rental->tanggal_selesai)->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Lama Sewa</span>
                    <span class="font-medium">
                        {{ \Carbon\Carbon::parse($rental->tanggal_mulai)->diffInDays($rental->tanggal_selesai) }} hari
                    </span>
                </div>
                <div class="border-t pt-3">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total</span>
                        <span class="text-blue-600">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Method -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h3 class="font-semibold text-gray-800 mb-4">Metode Pembayaran</h3>

            <div class="space-y-3">
                <label
                    class="flex items-center gap-4 p-4 border border-gray-300 rounded-xl hover:border-blue-500 cursor-pointer">
                    <input type="radio" name="payment_method" value="transfer" class="text-blue-600" checked>
                    <i class="fas fa-university text-2xl text-blue-600"></i>
                    <div class="flex-1">
                        <span class="font-medium">Transfer Bank</span>
                        <p class="text-sm text-gray-600">BCA, BNI, BRI, Mandiri</p>
                    </div>
                </label>

                <label
                    class="flex items-center gap-4 p-4 border border-gray-300 rounded-xl hover:border-blue-500 cursor-pointer">
                    <input type="radio" name="payment_method" value="ewallet" class="text-blue-600">
                    <i class="fas fa-wallet text-2xl text-green-600"></i>
                    <div class="flex-1">
                        <span class="font-medium">E-Wallet</span>
                        <p class="text-sm text-gray-600">Gopay, OVO, Dana, ShopeePay</p>
                    </div>
                </label>
            </div>
        </div>

        <!-- Payment Proof Upload -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h3 class="font-semibold text-gray-800 mb-4">Upload Bukti Pembayaran</h3>

            <form action="{{ route('user.payment.upload', $rental->id) }}" method="POST" enctype="multipart/form-data"
                id="paymentForm">
                @csrf

                <!-- File Upload -->
                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center mb-4">
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                    <p class="text-gray-600 mb-2">Upload bukti pembayaran</p>
                    <p class="text-sm text-gray-500 mb-4">Format: JPG, PNG (Maks. 2MB)</p>

                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/*" class="hidden"
                        required>
                    <label for="bukti_pembayaran"
                        class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 active:scale-95 transition-all cursor-pointer">
                        Pilih File
                    </label>

                    <!-- File Preview -->
                    <div id="filePreview" class="mt-4 hidden">
                        <img id="previewImage" class="mx-auto max-h-32 rounded-lg">
                        <p id="fileName" class="text-sm text-gray-600 mt-2"></p>
                    </div>
                </div>

                <!-- Bank Transfer Info (shown when transfer selected) -->
                <div id="bankInfo" class="bg-blue-50 rounded-xl p-4 mb-4">
                    <h4 class="font-semibold text-blue-800 mb-2">Transfer ke Rekening Berikut:</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span>Bank BCA</span>
                            <span class="font-mono">1234 5678 9012</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Atas Nama</span>
                            <span class="font-medium">Sewa Aja</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Jumlah Transfer</span>
                            <span class="font-bold text-blue-600">Rp
                                {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full btn-mobile bg-gradient-to-r from-green-600 to-green-500 text-white font-semibold rounded-2xl hover:from-green-700 hover:to-green-600 active:scale-95 transition-all shadow-lg">
                    Konfirmasi Pembayaran
                </button>
            </form>
        </div>
    </div>

    <script>
        // File upload preview
        document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('filePreview');
            const previewImage = document.getElementById('previewImage');
            const fileName = document.getElementById('fileName');

            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File terlalu besar',
                        text: 'Maksimal ukuran file 2MB'
                    });
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    fileName.textContent = file.name;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Payment method toggle
        document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const bankInfo = document.getElementById('bankInfo');
                if (this.value === 'transfer') {
                    bankInfo.classList.remove('hidden');
                } else {
                    bankInfo.classList.add('hidden');
                }
            });
        });

        // Form validation
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('bukti_pembayaran');
            if (!fileInput.files.length) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Bukti pembayaran diperlukan',
                    text: 'Silakan upload bukti pembayaran terlebih dahulu'
                });
            }
        });
    </script>
@endsection
