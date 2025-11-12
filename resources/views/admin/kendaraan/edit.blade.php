@extends('admin.layouts.app')
@section('title', 'Kendaraan')

@section('content')
    <div class="container px-6 py-1 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-amber-500 to-amber-600">
                <div class="flex items-center">
                    <div class="flex items-center justify-center w-10 h-10 mr-4 bg-white rounded-lg shadow-md">
                        <i class="text-lg text-amber-600 fas fa-edit"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-white">Edit Kendaraan</h2>
                        <p class="text-sm text-amber-100">Perbarui informasi kendaraan</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('kendaraan.update', $kendaraan->id) }}" method="POST" enctype="multipart/form-data"
                class="p-8">
                @csrf
                @method('PUT')

                <div class="p-4 mb-6 border-l-4 rounded-r-lg border-amber-500 bg-amber-50">
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 text-amber-600 fas fa-info-circle"></i>
                        <div>
                            <p class="text-sm font-medium text-amber-800">Informasi</p>
                            <p class="text-sm text-amber-700">Anda sedang mengedit kendaraan: <strong>{{ $kendaraan->merk }}
                                    {{ $kendaraan->model }}</strong></p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Kategori <span
                                class="text-red-500">*</span></label>
                        <select name="kategori_id" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg">
                            <option value hidden="">Pilih kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kategori_id', $kendaraan->kategori_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Nama Kendaraan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" value="{{ old('nama', $kendaraan->nama) }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg">
                        @error('nama')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Merk <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="merk" value="{{ old('merk', $kendaraan->merk) }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg">
                        @error('merk')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Model <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="model" value="{{ old('model', $kendaraan->model) }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg">
                        @error('model')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Tahun <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="tahun" value="{{ old('tahun', $kendaraan->tahun) }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg" min="1900"
                            max="{{ date('Y') }}">
                        @error('tahun')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">No. Plat <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="no_plat" value="{{ old('no_plat', $kendaraan->no_plat) }}" required
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg">
                        @error('no_plat')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Warna</label>
                        <input type="text" name="warna" value="{{ old('warna', $kendaraan->warna) }}"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg">
                        @error('warna')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Transmisi <span
                                class="text-red-500">*</span></label>
                        <select name="transmisi" required class="block w-full px-4 py-3 border border-gray-300 rounded-lg">
                            <option value="Automatic"
                                {{ old('transmisi', $kendaraan->transmisi) == 'Automatic' ? 'selected' : '' }}>Automatic
                            </option>
                            <option value="Manual"
                                {{ old('transmisi', $kendaraan->transmisi) == 'Manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                        @error('transmisi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Kapasitas Penumpang</label>
                        <input type="number" name="kapasitas_penumpang"
                            value="{{ old('kapasitas_penumpang', $kendaraan->kapasitas_penumpang) }}"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg" min="1">
                        @error('kapasitas_penumpang')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Foto Kendaraan</label>
                        <input type="file" name="foto" id="fotoInputEdit" accept="image/*"
                            class="block w-full text-sm text-gray-600">
                        <img id="previewFotoEdit" src="{{ $kendaraan->foto_url ?? '' }}" alt="Preview Foto"
                            class="mt-3 w-full max-h-56 object-contain rounded-lg {{ $kendaraan->foto ? '' : 'hidden' }}">
                        @error('foto')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Keterangan</label>
                        <textarea name="keterangan" rows="4" class="block w-full px-4 py-3 border border-gray-300 rounded-lg">{{ old('keterangan', $kendaraan->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end pt-6 space-x-3 border-t border-gray-200">
                    <a href="{{ route('kendaraan.index') }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        <i class="mr-2 fas fa-times"></i> Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white rounded-lg bg-gradient-to-r from-amber-500 to-amber-600">
                        <i class="mr-2 fas fa-save"></i> Update Kendaraan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('fotoInputEdit')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('previewFotoEdit');
            if (!file) {
                // hide if no file and no existing foto
                if (!preview.src) preview.classList.add('hidden');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(ev) {
                preview.src = ev.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        });
    </script>
@endsection
