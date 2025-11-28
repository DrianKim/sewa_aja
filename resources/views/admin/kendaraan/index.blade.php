@extends('admin.layouts.app')
@section('title', 'Kendaraan')
@section('content')
    <div class="container px-6 py-1 mx-auto">
        <div class="overflow-hidden bg-white shadow-lg rounded-xl">
            <!-- Header -->
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-blue-100 bg-gradient-to-r from-blue-600 to-blue-700">
                <h2 class="text-2xl font-bold text-white">Data Kendaraan</h2>
                <a href="{{ route('kendaraan.create') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white text-blue-600 font-semibold rounded-lg shadow-md hover:bg-blue-50 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
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
                                #
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Merek
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Nama Kendaraan
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Kategori
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Status
                            </th>
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
                                    <span class="text-sm font-medium text-gray-900">{{ $kendaraan->merek }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">{{ $kendaraan->nama_kendaraan }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-600">
                                        {{ $kendaraan->kategori?->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($kendaraan->status == 'tersedia')
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                            <i class="w-2 h-2 mr-1 bg-green-500 rounded-full"></i>
                                            Tersedia
                                        </span>
                                    @elseif($kendaraan->status == 'disewa')
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">
                                            <i class="w-2 h-2 mr-1 rounded-full bg-amber-500"></i>
                                            Disewa
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                            <i class="w-2 h-2 mr-1 bg-red-500 rounded-full"></i>
                                            Tidak Tersedia
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Show (modal) button -->
                                        <button type="button"
                                            class="show-btn inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm font-medium rounded-md hover:bg-blue-600 transition-colors duration-200"
                                            data-id="{{ $kendaraan->id }}" data-merek="{{ $kendaraan->merek }}"
                                            data-nama="{{ $kendaraan->nama_kendaraan }}"
                                            data-kategori="{{ $kendaraan->kategori?->nama_kategori }}"
                                            data-status="{{ $kendaraan->status }}"
                                            data-deskripsi="{{ $kendaraan->deskripsi }}"
                                            data-foto="{{ $kendaraan->foto ? asset('storage/' . $kendaraan->foto) : '' }}"
                                            title="Detail Kendaraan">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        <!-- Edit button -->
                                        <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-amber-500 text-white text-sm font-medium rounded-md hover:bg-amber-600 transition-colors duration-200"
                                            title="Edit Kendaraan">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Delete button -->
                                        <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}" method="POST"
                                            class="inline delete-form"
                                            data-name="{{ $kendaraan->merek }} {{ $kendaraan->nama_kendaraan }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-btn inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 transition-colors duration-200"
                                                title="Hapus Kendaraan">
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
                                        <i class="mb-3 text-5xl text-gray-300 fas fa-car"></i>
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

            <!-- Pagination (jika ada) -->
            @if (method_exists($data_kendaraan, 'hasPages') && $data_kendaraan->hasPages())
                <div class="px-6 py-4 border-t border-blue-100 bg-blue-50">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-blue-700">
                            Menampilkan {{ $data_kendaraan->firstItem() }} - {{ $data_kendaraan->lastItem() }} dari
                            {{ $data_kendaraan->total() }} kendaraan
                        </p>
                        <div class="flex space-x-2">
                            @if ($data_kendaraan->onFirstPage())
                                <span class="px-3 py-1 text-sm text-blue-400 bg-blue-100 rounded-lg">Sebelumnya</span>
                            @else
                                <a href="{{ $data_kendaraan->previousPageUrl() }}"
                                    class="px-3 py-1 text-sm text-blue-700 transition-colors duration-200 bg-white rounded-lg shadow-sm hover:bg-blue-50">Sebelumnya</a>
                            @endif

                            @if ($data_kendaraan->hasMorePages())
                                <a href="{{ $data_kendaraan->nextPageUrl() }}"
                                    class="px-3 py-1 text-sm text-blue-700 transition-colors duration-200 bg-white rounded-lg shadow-sm hover:bg-blue-50">Selanjutnya</a>
                            @else
                                <span class="px-3 py-1 text-sm text-blue-400 bg-blue-100 rounded-lg">Selanjutnya</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Show - Updated Design -->
    <div id="showModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto">
        <!-- Backdrop with blur -->
        <div class="fixed inset-0 transition-opacity bg-opacity-75 backdrop-blur-sm"></div>

        <!-- Modal Container -->
        <div class="flex items-center justify-center min-h-screen px-4 py-6">
            <div class="relative w-full max-w-2xl transition-all transform">
                <!-- Modal Card -->
                <div class="relative overflow-hidden bg-white shadow-2xl rounded-2xl">
                    <!-- Header - Blue Theme -->
                    <div class="px-6 py-5 bg-gradient-to-r from-blue-600 to-blue-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="flex items-center justify-center w-10 h-10 bg-white rounded-lg bg-opacity-20 backdrop-blur-sm">
                                    <i class="text-white fas fa-car"></i>
                                </div>
                                <h3 class="text-xl font-bold text-white">Detail Kendaraan</h3>
                            </div>
                            <button id="closeShow"
                                class="p-2 text-white transition-colors rounded-lg hover:bg-white hover:bg-opacity-20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Foto Kendaraan -->
                        <div id="foto-container" class="hidden mb-6">
                            <img id="m_foto" src="" alt="Foto Kendaraan"
                                class="object-cover w-full h-64 shadow-md rounded-xl">
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <!-- Info Items -->
                            <div class="p-4 transition-colors rounded-lg bg-blue-50 hover:bg-blue-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-blue-600 uppercase">Merek</p>
                                <p id="m_merek" class="text-base font-semibold text-blue-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-blue-50 hover:bg-blue-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-blue-600 uppercase">Nama Kendaraan
                                </p>
                                <p id="m_nama" class="text-base font-semibold text-blue-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-blue-50 hover:bg-blue-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-blue-600 uppercase">Kategori</p>
                                <p id="m_kategori" class="text-base font-semibold text-blue-900">-</p>
                            </div>

                            <div class="p-4 transition-colors rounded-lg bg-blue-50 hover:bg-blue-100">
                                <p class="mb-1 text-xs font-medium tracking-wide text-blue-600 uppercase">Status</p>
                                <p id="m_status" class="text-base font-semibold text-blue-900">-</p>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="p-4 mt-4 transition-colors rounded-lg bg-blue-50 hover:bg-blue-100">
                            <p class="mb-2 text-xs font-medium tracking-wide text-blue-600 uppercase">Deskripsi</p>
                            <p id="m_deskripsi" class="text-sm leading-relaxed text-blue-700 whitespace-pre-line">-</p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end px-6 py-4 border-t border-blue-100 bg-blue-50">
                        <button id="closeShowFooter"
                            class="inline-flex items-center px-5 py-2.5 bg-white border border-blue-200 rounded-lg font-medium text-blue-700 hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
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
                        cancelButtonColor: '#3b82f6',
                        confirmButtonText: '<i class="mr-2 fas fa-trash"></i> Ya, Hapus!',
                        cancelButtonText: '<i class="mr-2 fas fa-times"></i> Batal',
                        reverseButtons: true,
                        focusCancel: true,
                        customClass: {
                            popup: 'animated fadeInDown faster',
                            confirmButton: 'px-5 py-2.5 rounded-lg',
                            cancelButton: 'px-5 py-2.5 rounded-lg'
                        },
                        buttonsStyling: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading
                            Swal.fire({
                                title: 'Menghapus...',
                                html: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            });
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
                    document.getElementById('m_merek').textContent = btn.dataset.merek || '-';
                    document.getElementById('m_nama').textContent = btn.dataset.nama || '-';
                    document.getElementById('m_kategori').textContent = btn.dataset.kategori || '-';
                    document.getElementById('m_deskripsi').textContent = btn.dataset.deskripsi ||
                        '-';

                    // Status dengan badge
                    const status = btn.dataset.status || '-';
                    let statusHtml = '-';
                    if (status === 'tersedia') {
                        statusHtml =
                            '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Tersedia</span>';
                    } else if (status === 'disewa') {
                        statusHtml =
                            '<span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">Disewa</span>';
                    } else {
                        statusHtml =
                            '<span class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Tidak Tersedia</span>';
                    }
                    document.getElementById('m_status').innerHTML = statusHtml;

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

        // Success message handler
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'animated fadeInDown faster'
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'animated fadeInDown faster'
                }
            });
        @endif
    </script>

    <style>
        .rounded-xl {
            border-radius: 12px;
        }

        .shadow-lg {
            box-shadow: 0 10px 25px -3px rgba(59, 130, 246, 0.1), 0 4px 6px -2px rgba(59, 130, 246, 0.05);
        }

        .hover\:shadow-md:hover {
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1), 0 4px 6px -2px rgba(59, 130, 246, 0.05);
        }
    </style>
@endsection
