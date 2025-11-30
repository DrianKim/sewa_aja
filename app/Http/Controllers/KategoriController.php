<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $allKategori = Kategori::orderBy('nama_kategori')
            ->orderBy('jenis')
            ->get();

        // Debug: Lihat data yang didapat
        // dd($allKategori);

        // Hitung statistik yang benar
        $totalKategori = $allKategori->count(); // Total semua record (4)
        $uniqueCategories = $allKategori->unique('nama_kategori')->count(); // Kategori unik (2)

        // Hitung jumlah jenis di setiap kategori
        $totalMobil = $allKategori->where('nama_kategori', 'Mobil')->count(); // 3
        $totalMotor = $allKategori->where('nama_kategori', 'Motor')->count(); // 1

        // Group data untuk table
        $kategoris = $allKategori->groupBy('nama_kategori');

        return view('admin.kategori.index', compact(
            'kategoris',
            'totalKategori',
            'totalMobil',
            'totalMotor',
            'uniqueCategories'
        ));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'jenis.required' => 'Jenis kategori wajib diisi.',
            'jenis.max' => 'Jenis kategori maksimal 255 karakter.',
        ]);
        Kategori::create($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
