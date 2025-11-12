@extends('admin.layouts.app')
@section('title', 'Kendaraan')
@section('content')
    <div class="container px-6 py-1 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <!-- Header -->
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <h2 class="text-2xl font-bold text-white">Data Kendaraan</h2>
                <a href="{{ route('kendaraan.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-white text-blue-600 font-semibold rounded-lg shadow-md hover:bg-blue-50 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kendaraan
                </a>
            </div>
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th
                                class="w-16 px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                #</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Merk</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Model</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">No.
                                Plat</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Kategori</th>
                            <th
                                class="w-56 px-6 py-4 text-xs font-semibold tracking-wider text-center text-gray-700 uppercase">
                                <i class="fas fa-gear"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($data_kendaraan as $kendaraan)
                            <tr class="transition-colors duration-150 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $kendaraan->merk }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $kendaraan->model }} ({{ $kendaraan->tahun }})
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $kendaraan->no_plat }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $kendaraan->kategori?->nama }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Show (modal) button -->
                                        <button type="button"
                                            class="show-btn inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 transition-colors duration-200"
                                            data-id="{{ $kendaraan->id }}" data-merk="{{ $kendaraan->merk }}"
                                            data-nama="{{ $kendaraan->nama }}" data-model="{{ $kendaraan->model }}"
                                            data-tahun="{{ $kendaraan->tahun }}" data-no_plat="{{ $kendaraan->no_plat }}"
                                            data-warna="{{ $kendaraan->warna }}"
                                            data-transmisi="{{ $kendaraan->transmisi }}"
                                            data-kapasitas="{{ $kendaraan->kapasitas_penumpang }}"
                                            data-kategori="{{ $kendaraan->kategori?->nama }}"
                                            data-keterangan="{{ $kendaraan->keterangan }}"
                                            data-foto="{{ $kendaraan->foto_url ?? '' }}">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                        <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-amber-500 text-white text-sm font-medium rounded-md hover:bg-amber-600 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}" method="POST"
                                            class="inline delete-form"
                                            data-name="{{ $kendaraan->merk }} {{ $kendaraan->model }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-btn inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="mb-3 text-5xl text-gray-300 fas fa-folder-open"></i>
                                        <p class="text-sm font-medium text-gray-500">Tidak ada data kendaraan</p>
                                        <p class="mt-1 text-xs text-gray-400">Klik tombol "Tambah Kendaraan" untuk
                                            menambahkan data baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Show - Modern & Simple Design -->
    <div id="showModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto">
        <!-- Backdrop with blur -->
        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm"></div>

        <!-- Modal Container -->
        <div class="flex items-center justify-center min-h-screen px-4 py-6">
            <div class="relative w-full max-w-2xl transition-all transform">
                <!-- Modal Card -->
                <div class="relative overflow-hidden bg-white shadow-2xl rounded-2xl">
                    <!-- Header - Simple & Clean -->
                    <div class="px-6 py-5 bg-gradient-to-r from-blue-500 to-blue-600">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-white rounded-lg bg-opacity-20 backdrop-blur-sm">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white">Detail Kendaraan</h3>
                            </div>
                            <button id="closeShow" class="p-2 text-white transition-colors rounded-lg hover:bg-white hover:bg-opacity-20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Foto Kendaraan -->
                        <div id="foto-container" class="hidden mb-6">
                            <img id="m_foto" src="" alt="Foto Kendaraan" class="object-cover w-full h-64 shadow-md rounded-xl">
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <!-- Info Item -->
                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">Nama</p>
                                <p id="m_nama" class="text-base font-semibold text-gray-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">Merk</p>
                                <p id="m_merk" class="text-base font-semibold text-gray-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">Model</p>
                                <p id="m_model" class="text-base font-semibold text-gray-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">Tahun</p>
                                <p id="m_tahun" class="text-base font-semibold text-gray-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">No. Plat</p>
                                <p id="m_no_plat" class="text-base font-semibold text-gray-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">Warna</p>
                                <p id="m_warna" class="text-base font-semibold text-gray-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">Transmisi</p>
                                <p id="m_transmisi" class="text-base font-semibold text-gray-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">Kapasitas</p>
                                <p id="m_kapasitas" class="text-base font-semibold text-gray-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-gray-500 uppercase">Kategori</p>
                                <p id="m_kategori" class="text-base font-semibold text-gray-900">-</p>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div class="p-4 mt-4 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                            <p class="mb-2 text-xs font-medium tracking-wide text-gray-500 uppercase">Keterangan</p>
                            <p id="m_keterangan" class="text-sm leading-relaxed text-gray-700 whitespace-pre-line">-</p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end px-6 py-4 border-t border-gray-200 bg-gray-50">
                        <button id="closeShowFooter" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert Delete & Modal JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');
                    const name = form.getAttribute('data-name') || 'data ini';
                    Swal.fire({
                        title: 'Hapus Kendaraan?',
                        html: `Anda yakin ingin menghapus <strong>${name}</strong>?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: '<i class="mr-1 fas fa-trash"></i> Ya, Hapus!',
                        cancelButtonText: '<i class="mr-1 fas fa-times"></i> Batal',
                        reverseButtons: true,
                        focusCancel: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Show modal
            const showButtons = document.querySelectorAll('.show-btn');
            const showModal = document.getElementById('showModal');
            const closeShow = document.getElementById('closeShow');
            const closeShowFooter = document.getElementById('closeShowFooter');
            const fotoContainer = document.getElementById('foto-container');

            showButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('m_nama').textContent = btn.dataset.nama || '-';
                    document.getElementById('m_merk').textContent = btn.dataset.merk || '-';
                    document.getElementById('m_model').textContent = btn.dataset.model || '-';
                    document.getElementById('m_tahun').textContent = btn.dataset.tahun || '-';
                    document.getElementById('m_no_plat').textContent = btn.dataset.no_plat || '-';
                    document.getElementById('m_warna').textContent = btn.dataset.warna || '-';
                    document.getElementById('m_transmisi').textContent = btn.dataset.transmisi || '-';
                    document.getElementById('m_kapasitas').textContent = btn.dataset.kapasitas || '-';
                    document.getElementById('m_keterangan').textContent = btn.dataset.keterangan || '-';
                    document.getElementById('m_kategori').textContent = btn.dataset.kategori || '-';

                    const foto = btn.dataset.foto;
                    const img = document.getElementById('m_foto');
                    if (foto) {
                        img.src = foto;
                        fotoContainer.classList.remove('hidden');
                    } else {
                        img.src = '';
                        fotoContainer.classList.add('hidden');
                    }

                    showModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
            });

            function closeModalHandler() {
                showModal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            closeShow.addEventListener('click', closeModalHandler);
            closeShowFooter.addEventListener('click', closeModalHandler);

            // close modal on backdrop click
            showModal.addEventListener('click', (e) => {
                if (e.target === showModal) {
                    closeModalHandler();
                }
            });

            // close modal on ESC key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !showModal.classList.contains('hidden')) {
                    closeModalHandler();
                }
            });
        });
    </script>
@endsection
