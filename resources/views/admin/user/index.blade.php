{{-- @php
    // Hitung statistik tambahan
    $usersToday = App\Models\User::where('role', 'customer')->whereDate('created_at', today())->count();
    $usersThisMonth = App\Models\User::where('role', 'customer')
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();
@endphp --}}
@extends('admin.layouts.app')
@section('title', 'Manajemen User')

@section('content')
    <div class="container px-6 py-1 mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen User</h2>
                <p class="text-gray-600">Kelola data customer/pengguna rental Anda</p>
            </div>
        </div>

        <!-- Panel Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Total Customer</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $totalUsers }}</h3>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Customer Aktif</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $userAktif }}</h3>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Hari Ini</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $usersToday }}</h3>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-700 to-blue-800 rounded-xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Bulan Ini</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $usersThisMonth }}</h3>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                        <input type="text" id="searchInput" placeholder="Cari nama, email, atau no HP..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="text-gray-400 fas fa-search"></i>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 items-center">
                    <select id="sortFilter"
                        class="px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="terbaru">Terbaru</option>
                        <option value="terlama">Terlama</option>
                        <option value="nama_asc">Nama A-Z</option>
                        <option value="nama_desc">Nama Z-A</option>
                    </select>

                    <!-- Reset Filter Button -->
                    <button onclick="resetFilters()"
                        class="px-4 py-2 text-white bg-gray-400 rounded-lg hover:bg-gray-500 transition-colors duration-200">
                        Reset
                    </button>

                    <!-- Tambah User Button -->
                    <a href="{{ route('user.create') }}"
                        class="inline-flex items-center px-4 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah User
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-hidden bg-white shadow-lg rounded-xl">
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
                                Nama
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Email
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                No HP
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Alamat
                            </th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Terdaftar
                            </th>
                            <th
                                class="w-48 px-6 py-4 text-xs font-semibold tracking-wider text-center text-gray-700 uppercase">
                                <i class="fas fa-gear"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="userTableBody">
                        @forelse ($users as $index => $user)
                            <tr class="user-item transition-colors duration-150 hover:bg-gray-50"
                                data-search="{{ strtolower($user->nama . ' ' . $user->email . ' ' . $user->no_hp . ' ' . $user->alamat) }}"
                                data-created="{{ $user->created_at->timestamp }}">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600">
                                            <span class="text-xs font-bold text-white">
                                                {{ strtoupper(substr($user->nama, 0, 1)) }}
                                            </span>
                                        </div>
                                        <span class="font-semibold">{{ $user->nama }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <a href="mailto:{{ $user->email }}"
                                        class="text-blue-600 hover:text-blue-700 hover:underline">
                                        {{ $user->email }}
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <a href="tel:{{ $user->no_hp }}"
                                        class="text-blue-600 hover:text-blue-700 hover:underline">
                                        {{ $user->no_hp }}
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="max-w-xs truncate" title="{{ $user->alamat }}">
                                        {{ $user->alamat }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $user->created_at->format('d/m/Y') }}
                                    <div class="text-xs text-gray-400">
                                        {{ $user->created_at->diffForHumans() }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('user.edit', $user->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-amber-500 text-white text-sm font-medium rounded-md hover:bg-amber-600 transition-colors duration-200"
                                            title="Edit User">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            class="inline delete-form" data-user-name="{{ $user->nama }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                class="delete-btn inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-sm font-medium rounded-md hover:bg-red-600 transition-colors duration-200"
                                                title="Hapus User">
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
                                <td colspan="7" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="mb-3 text-5xl text-gray-300 fas fa-users"></i>
                                        <p class="text-sm font-medium text-gray-500">Tidak ada data user</p>
                                        <p class="mt-1 text-xs text-gray-400">
                                            Klik "Tambah User" untuk membuat user baru.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200" id="paginationContainer">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    {{-- JavaScript untuk Filter --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const sortFilter = document.getElementById('sortFilter');
            const userItems = document.querySelectorAll('.user-item');
            const paginationContainer = document.getElementById('paginationContainer');

            function filterUsers() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedSort = sortFilter.value;

                let visibleCount = 0;
                const visibleUsers = [];

                userItems.forEach(item => {
                    const searchData = item.dataset.search;
                    const createdTime = parseInt(item.dataset.created);

                    const matchSearch = searchTerm === '' || searchData.includes(searchTerm);

                    if (matchSearch) {
                        item.style.display = 'table-row';
                        visibleCount++;
                        visibleUsers.push({
                            element: item,
                            nama: item.querySelector('td:nth-child(2)').textContent.trim()
                                .toLowerCase(),
                            created: createdTime
                        });
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Sort users
                if (selectedSort !== 'terbaru') {
                    sortUsers(visibleUsers, selectedSort);
                }

                // Tampilkan/sembunyikan pagination
                if (paginationContainer) {
                    if (searchTerm !== '') {
                        paginationContainer.style.display = 'none';
                    } else {
                        paginationContainer.style.display = 'block';
                    }
                }

                // Tampilkan pesan jika tidak ada hasil
                const emptyState = document.querySelector('.empty-state-filter');
                if (visibleCount === 0) {
                    if (!emptyState) {
                        showEmptyState();
                    }
                } else {
                    if (emptyState) {
                        emptyState.remove();
                    }
                }
            }

            function sortUsers(users, sortType) {
                users.sort((a, b) => {
                    switch (sortType) {
                        case 'terlama':
                            return a.created - b.created;
                        case 'nama_asc':
                            return a.nama.localeCompare(b.nama);
                        case 'nama_desc':
                            return b.nama.localeCompare(a.nama);
                        default:
                            return b.created - a.created;
                    }
                });

                // Reorder DOM elements
                const tbody = document.getElementById('userTableBody');
                users.forEach(user => {
                    tbody.appendChild(user.element);
                });
            }

            function showEmptyState() {
                const tableBody = document.getElementById('userTableBody');
                const emptyRow = document.createElement('tr');
                emptyRow.className = 'empty-state-filter';
                emptyRow.innerHTML = `
                    <td colspan="7" class="px-6 py-8 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="mb-3 text-5xl text-gray-300 fas fa-search"></i>
                            <p class="text-sm font-medium text-gray-500">Tidak ada user yang ditemukan</p>
                            <p class="mt-1 text-xs text-gray-400">
                                Coba ubah kata kunci pencarian
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
                searchInput.addEventListener('input', debounce(filterUsers, 300));
            }

            if (sortFilter) {
                sortFilter.addEventListener('change', filterUsers);
            }

            // Handle all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('.delete-form');
                    const userName = form.getAttribute('data-user-name');

                    Swal.fire({
                        title: 'Hapus User?',
                        html: `Anda yakin ingin menghapus user:<br><strong>"${userName}"</strong>?<br><span style="color: #ef4444; font-size: 12px;">Data ini tidak dapat dikembalikan!</span>`,
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
            const sortFilter = document.getElementById('sortFilter');

            if (searchInput) searchInput.value = '';
            if (sortFilter) sortFilter.value = 'terbaru';

            // Trigger filter update
            if (searchInput) {
                const event = new Event('input');
                searchInput.dispatchEvent(event);
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
