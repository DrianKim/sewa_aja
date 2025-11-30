@extends('admin.layouts.app')
@section('title', 'Harga Kendaraan')

@section('content')
    <div class="container px-6 py-1 mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Data Harga Kendaraan</h2>
                <p class="text-gray-600">Kelola semua harga kendaraan rental Anda</p>
            </div>
        </div>

        <!-- Panel Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Total Harga</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $totalHarga }}</h3>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Belum Ada Harga</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $belumAdaHarga }}</h3>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Harga Mobil</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $hargaMobil }}</h3>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-700 to-blue-800 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Harga Motor</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $hargaMotor }}</h3>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="p-4 mb-6 bg-white rounded-xl shadow-lg">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between w-full">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari kendaraan, kategori, atau jenis..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="text-gray-400 fas fa-search"></i>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 items-center">
                    <select id="categoryFilter"
                        class="px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">Semua Kategori</option>
                        @foreach ($groupedHargas as $namaKategori => $hargas)
                            <option value="{{ $namaKategori }}">{{ $namaKategori }}</option>
                        @endforeach
                    </select>

                    <!-- Reset Filter Button -->
                    <button onclick="resetFilters()"
                        class="px-4 py-2 text-white bg-gray-400 rounded-lg hover:bg-gray-500 transition-colors duration-200">
                        Reset
                    </button>

                    <!-- Tambah Harga Button -->
                    <a href="{{ route('harga.create') }}"
                        class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Harga
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-hidden bg-white shadow-lg rounded-xl">
            <!-- Table Header -->
            <div class="px-6 py-4 border-b border-blue-100 bg-gradient-to-r from-blue-600 to-blue-700">
                <h2 class="text-xl font-bold text-white">Daftar Harga Kendaraan</h2>
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
                                Kategori
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Kendaraan
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Harga Perhari
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Tanggal Berlaku
                            </th>
                            <th
                                class="w-48 px-6 py-4 text-xs font-semibold tracking-wider text-center text-gray-700 uppercase">
                                <i class="fas fa-gear"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="hargaTableBody">
                        @forelse ($groupedHargas as $namaKategori => $hargas)
                            {{-- Row Judul (Nama Kategori) --}}
                            <tr class="harga-group bg-blue-50" data-kategori="{{ strtolower($namaKategori) }}">
                                <td class="px-6 py-4 font-semibold text-gray-900" colspan="6">
                                    <div class="flex items-center">
                                        <i class="mr-3 text-blue-600 fas fa-folder"></i>
                                        {{ $namaKategori }}
                                    </div>
                                </td>
                            </tr>

                            {{-- List Harga di bawahnya --}}
                            @foreach ($hargas as $index => $harga)
                                <tr class="harga-item transition-colors duration-150 hover:bg-gray-50"
                                    data-kategori="{{ strtolower($namaKategori) }}"
                                    data-search="{{ strtolower($namaKategori . ' ' . $harga->kendaraan->kategori->jenis . ' ' . $harga->kendaraan->merek . ' ' . $harga->kendaraan->nama_kendaraan) }}">
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="flex items-center">
                                            <i class="mr-3 text-gray-400 fas fa-chevron-right"></i>
                                            {{ $harga->kendaraan->kategori->jenis ?? '-' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $harga->kendaraan->merek }} {{ $harga->kendaraan->nama_kendaraan }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="flex items-center">
                                            Rp {{ number_format($harga->harga_perhari, 0, ',', '.') }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ \Carbon\Carbon::parse($harga->tanggal_berlaku)->format('d/m/Y') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('harga.edit', $harga->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-amber-500 text-white text-sm font-medium rounded-md hover:bg-amber-600 transition-colors duration-200"
                                                title="Edit Harga">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('harga.destroy', $harga->id) }}" method="POST"
                                                class="inline delete-form"
                                                data-harga-info="{{ $harga->kendaraan->merek }} {{ $harga->kendaraan->nama_kendaraan }} - Rp {{ number_format($harga->harga_perhari, 0, ',', '.') }}">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button"
                                                    class="delete-btn inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 transition-colors duration-200"
                                                    title="Hapus Harga">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="mb-3 text-5xl text-gray-300 fas fa-tags"></i>
                                        <p class="text-sm font-medium text-gray-500">Tidak ada data harga</p>
                                        <p class="mt-1 text-xs text-gray-400">
                                            Klik "Tambah Harga" untuk membuat data.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Filter --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const hargaGroups = document.querySelectorAll('.harga-group');
            const hargaItems = document.querySelectorAll('.harga-item');

            function filterHarga() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value.toLowerCase();

                let hasVisibleItems = false;

                hargaGroups.forEach(group => {
                    const kategoriName = group.dataset.kategori;
                    let groupHasVisibleItems = false;

                    // Cari semua item dalam group ini
                    const itemsInGroup = document.querySelectorAll(
                        `.harga-item[data-kategori="${kategoriName}"]`);

                    itemsInGroup.forEach(item => {
                        const searchData = item.dataset.search;

                        const matchSearch = searchTerm === '' || searchData.includes(searchTerm);
                        const matchCategory = selectedCategory === '' || kategoriName.includes(
                            selectedCategory);

                        if (matchSearch && matchCategory) {
                            item.style.display = 'table-row';
                            groupHasVisibleItems = true;
                            hasVisibleItems = true;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Tampilkan/sembunyikan group header
                    if (groupHasVisibleItems) {
                        group.style.display = 'table-row';
                    } else {
                        group.style.display = 'none';
                    }
                });

                // Tampilkan pesan jika tidak ada hasil
                const emptyState = document.querySelector('.empty-state');
                if (!hasVisibleItems) {
                    if (!emptyState) {
                        showEmptyState();
                    }
                } else {
                    if (emptyState) {
                        emptyState.remove();
                    }
                }
            }

            function showEmptyState() {
                const tableBody = document.getElementById('hargaTableBody');
                const emptyRow = document.createElement('tr');
                emptyRow.className = 'empty-state';
                emptyRow.innerHTML = `
            <td colspan="6" class="px-6 py-8 text-center">
                <div class="flex flex-col items-center justify-center">
                    <i class="mb-3 text-5xl text-gray-300 fas fa-search"></i>
                    <p class="text-sm font-medium text-gray-500">Tidak ada harga yang ditemukan</p>
                    <p class="mt-1 text-xs text-gray-400">
                        Coba ubah kata kunci pencarian atau filter
                    </p>
                </div>
            </td>
        `;
                tableBody.appendChild(emptyRow);
            }

            // Debounce function untuk optimasi performance
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Event listeners untuk filtering
            if (searchInput) {
                searchInput.addEventListener('input', debounce(filterHarga, 300));
            }

            if (categoryFilter) {
                categoryFilter.addEventListener('change', filterHarga);
            }

            // Reset filter function
            window.resetFilters = function() {
                if (searchInput) searchInput.value = '';
                if (categoryFilter) categoryFilter.value = '';

                // Trigger filter update
                if (searchInput) {
                    const event = new Event('input');
                    searchInput.dispatchEvent(event);
                }
            };

            // Handle all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('.delete-form');
                    const hargaInfo = form.getAttribute('data-harga-info');

                    Swal.fire({
                        title: 'Hapus Data Harga?',
                        html: `Anda yakin ingin menghapus harga untuk:<br><strong>"${hargaInfo}"</strong>?`,
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

                            // Submit form
                            form.submit();
                        }
                    });
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
        });

        // Function untuk reset semua filter
        function resetFilters() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const statusFilter = document.getElementById('statusFilter');

            if (searchInput) searchInput.value = '';
            if (categoryFilter) categoryFilter.value = '';
            if (statusFilter) statusFilter.value = '';

            // Trigger filter update
            if (searchInput) {
                const event = new Event('input');
                searchInput.dispatchEvent(event);
            }
            if (categoryFilter) {
                const event = new Event('change');
                categoryFilter.dispatchEvent(event);
            }
            if (statusFilter) {
                const event = new Event('change');
                statusFilter.dispatchEvent(event);
            }
        }
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
