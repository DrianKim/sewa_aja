@extends('admin.layouts.app')
@section('title', 'Kendaraan')
@section('content')
    <div class="container px-6 py-1 mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Data Kendaraan</h2>
                <p class="text-gray-600">Kelola semua kendaraan rental Anda</p>
            </div>
            <a href="{{ route('kendaraan.create') }}"
                class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kendaraan
            </a>
        </div>

        <!-- Search and Filter -->
        <div class="p-4 mb-6 bg-white rounded-xl shadow-lg">
            <form action="{{ route('kendaraan.index') }}" method="GET"
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between w-full">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kendaraan..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="text-gray-400 fas fa-search"></i>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 items-center">
                    <select name="kategori" onchange="this.form.submit()"
                        class="px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->nama_kategori }}"
                                {{ request('kategori') == $kategori->nama_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>

                    <select name="status" onchange="this.form.submit()"
                        class="px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disewa" {{ request('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                        <option value="tidak_tersedia" {{ request('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak
                            Tersedia</option>
                    </select>

                    <!-- Reset Filter Button -->
                    <a href="{{ route('kendaraan.index') }}"
                        class="px-4 py-2 text-white bg-gray-400 rounded-lg hover:bg-gray-500 transition-colors duration-200">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($data_kendaraan as $kendaraan)
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                    <!-- Foto Kendaraan -->
                    <div class="relative h-48 bg-gray-200 overflow-hidden">
                        @if ($kendaraan->foto)
                            <img src="{{ asset('storage/' . $kendaraan->foto) }}" alt="{{ $kendaraan->nama_kendaraan }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                                <i class="text-4xl text-blue-400 fas fa-car"></i>
                            </div>
                        @endif

                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            @if ($kendaraan->status == 'tersedia')
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full shadow-sm">
                                    <i class="w-2 h-2 mr-1 bg-green-500 rounded-full"></i>
                                    Tersedia
                                </span>
                            @elseif($kendaraan->status == 'disewa')
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800 shadow-sm">
                                    <i class="w-2 h-2 mr-1 rounded-full bg-amber-500"></i>
                                    Disewa
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full shadow-sm">
                                    <i class="w-2 h-2 mr-1 bg-red-500 rounded-full"></i>
                                    Tidak Tersedia
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="mb-3">
                            <h3 class="text-lg font-bold text-gray-800 truncate">{{ $kendaraan->nama_kendaraan }}</h3>
                            <p class="text-sm text-gray-600">{{ $kendaraan->merek }}</p>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="w-4 h-4 mr-2 text-blue-500 fas fa-tag"></i>
                                <span>{{ $kendaraan->kategori?->nama_kategori ?? '-' }}</span>
                            </div>

                            @if ($kendaraan->deskripsi)
                                <div class="flex items-start text-sm text-gray-600">
                                    <i class="w-4 h-4 mr-2 mt-0.5 text-blue-500 fas fa-align-left"></i>
                                    <span class="line-clamp-2">{{ $kendaraan->deskripsi }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <div class="flex gap-2">
                                <!-- Show button -->
                                <button type="button"
                                    class="show-btn inline-flex items-center justify-center w-8 h-8 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200"
                                    data-id="{{ $kendaraan->id }}" data-merek="{{ $kendaraan->merek }}"
                                    data-nama="{{ $kendaraan->nama_kendaraan }}"
                                    data-kategori="{{ $kendaraan->kategori?->nama_kategori }}"
                                    data-status="{{ $kendaraan->status }}" data-deskripsi="{{ $kendaraan->deskripsi }}"
                                    data-foto="{{ $kendaraan->foto ? asset('storage/' . $kendaraan->foto) : '' }}"
                                    title="Detail Kendaraan">
                                    <i class="text-xs fas fa-eye"></i>
                                </button>

                                <!-- Edit button -->
                                <a href="{{ route('kendaraan.edit', $kendaraan->id) }}"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-colors duration-200"
                                    title="Edit Kendaraan">
                                    <i class="text-xs fas fa-edit"></i>
                                </a>
                            </div>

                            <!-- Delete button -->
                            <form action="{{ route('kendaraan.destroy', $kendaraan->id) }}" method="POST"
                                class="inline delete-form"
                                data-name="{{ $kendaraan->merek }} {{ $kendaraan->nama_kendaraan }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="delete-btn inline-flex items-center justify-center w-8 h-8 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200"
                                    title="Hapus Kendaraan">
                                    <i class="text-xs fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <div class="flex flex-col items-center justify-center">
                            <i class="mb-4 text-6xl text-gray-300 fas fa-car"></i>
                            <h3 class="mb-2 text-lg font-medium text-gray-500">Tidak ada data kendaraan</h3>
                            <p class="mb-6 text-gray-400">Klik tombol "Tambah Kendaraan" untuk menambahkan data baru</p>
                            <a href="{{ route('kendaraan.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                <i class="mr-2 fas fa-plus"></i>
                                Tambah Kendaraan Pertama
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if (method_exists($data_kendaraan, 'hasPages') && $data_kendaraan->hasPages())
            <div class="mt-8 px-6 py-4 bg-white rounded-xl shadow-lg">
                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                    <p class="text-sm text-gray-600">
                        Menampilkan {{ $data_kendaraan->firstItem() }} - {{ $data_kendaraan->lastItem() }} dari
                        {{ $data_kendaraan->total() }} kendaraan
                    </p>
                    <div class="flex space-x-2">
                        @if ($data_kendaraan->onFirstPage())
                            <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg">Sebelumnya</span>
                        @else
                            <a href="{{ $data_kendaraan->previousPageUrl() }}"
                                class="px-4 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">Sebelumnya</a>
                        @endif

                        @if ($data_kendaraan->hasMorePages())
                            <a href="{{ $data_kendaraan->nextPageUrl() }}"
                                class="px-4 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">Selanjutnya</a>
                        @else
                            <span class="px-4 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg">Selanjutnya</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
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
                        <div id="foto-container" class="mb-6">
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
                        img.src =
                            'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0zMiAyMEMyOC42ODYzIDIwIDI2IDIyLjY4NjMgMjYgMjZDMjYgMjkuMzEzNyAyOC42ODYzIDMyIDMyIDMyQzM1LjMxMzcgMzIgMzggMjkuMzEzNyAzOCAyNkMzOCAyMi42ODYzIDM1LjMxMzcgMjAgMzIgMjBaTTMyIDM2QzI2LjQ3NzIgMzYgMjIgNDAuNDc3MiAyMiA0NkgyQzIyIDU3LjA0NTcgMjYuOTU0MyA2MiAzMiA2MkMzNy4wNDU3IDYyIDQyIDU3LjA0NTcgNDIgNDZINDJDMzggNDAuNDc3MiAzMy41MjI4IDM2IDMyIDM2WiIgZmlsbD0iIzlDQzRGMSIvPgo8L3N2Zz4K';
                        fotoContainer.classList.remove('hidden');
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

        .hover\:shadow-xl:hover {
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.1), 0 10px 10px -5px rgba(59, 130, 246, 0.04);
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>
@endsection
