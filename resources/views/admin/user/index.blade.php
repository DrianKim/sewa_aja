@extends('admin.layouts.app')
@section('title', 'Manajemen User')

@section('content')
    <div class="container px-6 py-1 mx-auto">
        <div class="overflow-hidden bg-white shadow-lg rounded-xl">
            <!-- Header dengan button tambah -->
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-blue-100 bg-gradient-to-r from-blue-600 to-blue-700">
                <div>
                    <h2 class="text-2xl font-bold text-white">Manajemen User</h2>
                    <p class="mt-1 text-sm text-blue-100">Kelola data customer/pengguna</p>
                </div>
                <a href="{{ route('user.create') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white text-blue-600 font-semibold rounded-lg shadow-md hover:bg-blue-50 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah User
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 gap-4 px-6 py-4 md:grid-cols-2">
                <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-200 rounded-lg">
                        <i class="text-blue-600 fas fa-users"></i>
                    </div>
                    <div>
                        <p class="text-xs text-blue-600 font-medium">Total User</p>
                        <p class="text-lg font-bold text-blue-900">{{ $totalUsers }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center justify-center w-10 h-10 bg-green-200 rounded-lg">
                        <i class="text-green-600 fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="text-xs text-green-600 font-medium">User Aktif</p>
                        <p class="text-lg font-bold text-green-900">{{ $userAktif }}</p>
                    </div>
                </div>
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
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($users as $index => $user)
                            <tr class="transition-colors duration-150 hover:bg-gray-50">
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
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    {{-- SweetAlert Delete Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
