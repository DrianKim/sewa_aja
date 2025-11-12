@extends('admin.layouts.app')
@section('title', 'Tambah Detail Kendaraan')

@section('content')
    <div class="container px-6 py-1 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 mr-4 bg-white rounded-lg shadow-md">
                        <i class="text-lg text-blue-600 fas fa-car"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Tambah Detail Kendaraan</h2>
                        <p class="text-sm text-blue-100">Isi form di bawah untuk menambahkan detail harga kendaraan</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('detail.store') }}" method="POST" class="p-8">
                @csrf

                <!-- Kendaraan -->
                <div class="mb-6">
                    <label for="kendaraan_id" class="block mb-2 text-sm font-semibold text-gray-700">
                        Kendaraan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="text-gray-400 fas fa-car-side"></i>
                        </div>
                        <select name="kendaraan_id" id="kendaraan_id"
                            class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 transition-all duration-200 border border-gray-300 rounded-lg appearance-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400">
                            <option value="" hidden>-- Pilih Kendaraan --</option>
                            @foreach ($kendaraans as $kendaraan)
                                <option value="{{ $kendaraan->id }}">{{ $kendaraan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('kendaraan_id')
                        <p class="mt-2 text-sm text-red-600"><i class="mr-1 fas fa-exclamation-circle"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Harga per Hari</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-coins"></i>
                            </div>
                            <input type="number" name="harga_per_hari" placeholder="Contoh: 100000"
                                class="block w-full py-3 pl-12 pr-4 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Harga per Minggu</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-wallet"></i>
                            </div>
                            <input type="number" name="harga_per_minggu" placeholder="Contoh: 600000"
                                class="block w-full py-3 pl-12 pr-4 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Harga per Bulan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-calendar-alt"></i>
                            </div>
                            <input type="number" name="harga_per_bulan" placeholder="Contoh: 2500000"
                                class="block w-full py-3 pl-12 pr-4 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Harga per Tahun</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-calendar"></i>
                            </div>
                            <input type="number" name="harga_per_tahun" placeholder="Contoh: 25000000"
                                class="block w-full py-3 pl-12 pr-4 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400">
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="mt-6">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Status</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="text-gray-400 fas fa-toggle-on"></i>
                        </div>
                        <select name="status"
                            class="block w-full py-3 pl-12 pr-4 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400">
                            <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="tidak_tersedia" {{ old('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak
                                Tersedia</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-end pt-6 mt-6 space-x-3 border-t border-gray-200">
                    <a href="{{ route('detail.index') }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 hover:shadow-md">
                        <i class="mr-2 fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-md hover:from-blue-600 hover:to-blue-700 hover:shadow-lg transform hover:-translate-y-0.5">
                        <i class="mr-2 fas fa-save"></i>
                        Simpan Detail
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
