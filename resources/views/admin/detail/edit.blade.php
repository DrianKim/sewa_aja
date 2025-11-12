@extends('admin.layouts.app')
@section('title', 'Edit Detail Kendaraan')

@section('content')
    <div class="container px-6 py-1 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-amber-500 to-amber-600">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 mr-4 bg-white rounded-lg shadow-md">
                        <i class="text-lg text-amber-600 fas fa-edit"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit Detail Kendaraan</h2>
                        <p class="text-sm text-amber-100">Perbarui data harga dan status kendaraan di bawah</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('detail.update', $detail->id) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <!-- Info Box -->
                <div class="p-4 mb-6 border-l-4 rounded-r-lg border-amber-500 bg-amber-50">
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 text-amber-600 fas fa-info-circle"></i>
                        <div>
                            <p class="text-sm font-medium text-amber-800">Informasi</p>
                            <p class="text-sm text-amber-700">
                                Anda sedang mengedit detail kendaraan:
                                <strong>{{ $detail->kendaraan->nama ?? 'Tidak diketahui' }}</strong>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kendaraan -->
                <div class="mb-6">
                    <label for="kendaraan_id" class="block mb-2 text-sm font-semibold text-gray-700">
                        Kendaraan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i class="text-gray-400 fas fa-car-side"></i>
                        </div>
                        <select name="kendaraan_id" id="kendaraan_id" required
                            class="block w-full py-3 pl-12 pr-4 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400">
                            <option value="" hidden>-- Pilih Kendaraan --</option>
                            @foreach ($kendaraans as $kendaraan)
                                <option value="{{ $kendaraan->id }}"
                                    {{ $kendaraan->id == $detail->kendaraan_id ? 'selected' : '' }}>
                                    {{ $kendaraan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Harga -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Harga per Hari</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-coins"></i>
                            </div>
                            <input type="number" name="harga_per_hari"
                                value="{{ old('harga_per_hari', $detail->harga_per_hari) }}"
                                class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Harga per Minggu</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-wallet"></i>
                            </div>
                            <input type="number" name="harga_per_minggu"
                                value="{{ old('harga_per_minggu', $detail->harga_per_minggu) }}"
                                class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400">
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
                            <input type="number" name="harga_per_bulan"
                                value="{{ old('harga_per_bulan', $detail->harga_per_bulan) }}"
                                class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400">
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Harga per Tahun</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="text-gray-400 fas fa-calendar"></i>
                            </div>
                            <input type="number" name="harga_per_tahun"
                                value="{{ old('harga_per_tahun', $detail->harga_per_tahun) }}"
                                class="block w-full py-3 pl-12 pr-4 text-gray-900 placeholder-gray-400 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400">
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
                            class="block w-full py-3 pl-12 pr-4 text-gray-900 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 hover:border-gray-400">
                            <option value="tersedia" {{ $detail->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="tidak_tersedia" {{ $detail->status == 'tidak_tersedia' ? 'selected' : '' }}>Tidak
                                Tersedia</option>
                            <option value="pending" {{ $detail->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disewa" {{ $detail->status == 'disewa' ? 'selected' : '' }}>Disewa</option>
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
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white transition-all duration-200 bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg shadow-md hover:from-amber-600 hover:to-amber-700 hover:shadow-lg transform hover:-translate-y-0.5">
                        <i class="mr-2 fas fa-save"></i>
                        Update Detail
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
