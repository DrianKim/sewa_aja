@extends('admin.layouts.app')
@section('title', 'Kategori')

@section('content')
    <div class="container px-6 py-1 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <!-- Header dengan button tambah -->
            <div
                class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <h2 class="text-2xl font-bold text-white">Data Kategori</h2>
                <a href="{{ route('kategori.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-white text-blue-600 font-semibold rounded-lg shadow-md hover:bg-blue-50 hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kategori
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
                                Nama</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase">
                                Deskripsi</th>
                            <th
                                class="w-48 px-6 py-4 text-xs font-semibold tracking-wider text-center text-gray-700 uppercase">
                                <i class="fas fa-gear"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($data_kategori as $kategori)
                            <tr class="transition-colors duration-150 hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ $kategori->nama }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $kategori->deskripsi }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-amber-500 text-white text-sm font-medium rounded-md hover:bg-amber-600 transition-colors duration-200">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                            class="inline delete-form"
                                            data-kategori-nama="{{ $kategori->nama }}">
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
                                <td colspan="4" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="mb-3 text-5xl text-gray-300 fas fa-folder-open"></i>
                                        <p class="text-sm font-medium text-gray-500">Tidak ada data kategori</p>
                                        <p class="mt-1 text-xs text-gray-400">Klik tombol "Tambah Kategori" untuk menambahkan data baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- SweetAlert Delete Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle all delete buttons
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('.delete-form');
                    const kategoriNama = form.getAttribute('data-kategori-nama');

                    Swal.fire({
                        title: 'Hapus Kategori?',
                        html: `Anda yakin ingin menghapus kategori <strong>${kategoriNama}</strong>?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: '<i class="mr-1 fas fa-trash"></i> Ya, Hapus!',
                        cancelButtonText: '<i class="mr-1 fas fa-times"></i> Batal',
                        reverseButtons: true,
                        focusCancel: true,
                        customClass: {
                            popup: 'animated fadeInDown faster',
                            confirmButton: 'px-5 py-2.5',
                            cancelButton: 'px-5 py-2.5'
                        },
                        buttonsStyling: true
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
                                }
                            });

                            // Submit form
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
