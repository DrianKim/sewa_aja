<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index()
    {
        $data_kendaraan = Kendaraan::with('kategori')->latest()->paginate(10);
        return view('admin.kendaraan.index', compact('data_kendaraan'));
    }

    // untuk form create
    public function create()
    {
        // ambil kategori unik
        $kategori = Kategori::select('nama_kategori')
            ->distinct()
            ->get();

        return view('admin.kendaraan.create', compact('kategori'));
    }

    public function getJenis($namaKategori)
    {
        $jenis = Kategori::where('nama_kategori', $namaKategori)->pluck('jenis');
        return response()->json($jenis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori'     => 'required|string',
            'jenis'           => 'required|string',
            'merek'           => 'required|string|max:255',
            'nama_kendaraan'  => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Cari kategori berdasarkan nama_kategori DAN jenis
        $kategori = Kategori::where('nama_kategori', $request->id_kategori)
            ->where('jenis', $request->jenis)
            ->firstOrFail();

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kendaraan', 'public');
        }

        Kendaraan::create([
            'merek'          => $request->merek,
            'nama_kendaraan' => $request->nama_kendaraan,
            'id_kategori'    => $kategori->id, // Gunakan id dari kategori yang ditemukan
            'status'         => 'Tersedia',
            'foto'           => $fotoPath,
            'deskripsi'      => $request->deskripsi,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.kendaraan.edit', compact('kendaraan', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([
            'id_kategori'     => 'required|exists:kategori,id',
            'merek'           => 'required|string|max:255',
            'nama_kendaraan'  => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'status'          => 'required|in:Tersedia,Disewa,Perbaikan',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Foto
        $fotoPath = $kendaraan->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }

            $fotoPath = $request->file('foto')->store('kendaraan', 'public');
        }

        $kendaraan->update([
            'id_kategori'    => $request->id_kategori,
            'merek'          => $request->merek,
            'nama_kendaraan' => $request->nama_kendaraan,
            'deskripsi'      => $request->deskripsi,
            'status'         => $request->status,
            'foto'           => $fotoPath,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        if ($kendaraan->foto && Storage::disk('public')->exists($kendaraan->foto)) {
            Storage::disk('public')->delete($kendaraan->foto);
        }

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
