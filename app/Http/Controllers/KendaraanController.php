<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        // Tambah with('harga') untuk load data harga
        $query = Kendaraan::with(['kategori', 'harga' => function ($q) {
            $q->orderBy('tanggal_berlaku', 'desc'); // Ambil harga terbaru
        }])->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('merek', 'like', "%{$search}%")
                    ->orWhere('nama_kendaraan', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('nama_kategori', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $data_kendaraan = $query->paginate(12);

        $kategoris = Kategori::select('nama_kategori')
            ->distinct()
            ->orderBy('nama_kategori')
            ->get();

        // Hitung statistik - Cara lebih fleksibel
        $totalKendaraan = Kendaraan::count();

        // Cari ID kategori mobil dan motor
        $mobilKategori = Kategori::where('nama_kategori', 'like', '%mobil%')->first();
        $motorKategori = Kategori::where('nama_kategori', 'like', '%motor%')->first();

        $totalMobil = $mobilKategori ?
            Kendaraan::where('id_kategori', $mobilKategori->id)->count() : 0;

        $totalMotor = $motorKategori ?
            Kendaraan::where('id_kategori', $motorKategori->id)->count() : 0;

        $totalTersedia = Kendaraan::where('status', 'tersedia')->count();

        return view('admin.kendaraan.index', compact(
            'data_kendaraan',
            'kategoris',
            'totalKendaraan',
            'totalMobil',
            'totalMotor',
            'totalTersedia'
        ));
    }

    public function create()
    {
        $kategori = Kategori::select('nama_kategori')
            ->distinct()
            ->get();

        return view('admin.kendaraan.create', compact('kategori'));
    }

    // public function getJenis($namaKategori)
    // {
    //     $jenis = Kategori::where('nama_kategori', $namaKategori)->pluck('jenis');
    //     return response()->json($jenis);
    // }
    public function getJenis($namaKategori)
    {
        $jenis = Kategori::where('nama_kategori', $namaKategori)
            ->pluck('jenis')
            ->unique()
            ->values(); // reset key array
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
        $kendaraan = Kendaraan::with('kategori')->findOrFail($id);

        $selectedJenis = $kendaraan->kategori->jenis ?? null;
        $selectedKategori = $kendaraan->kategori->nama_kategori ?? null;

        $kategori = Kategori::select('nama_kategori')->distinct()->get();

        return view('admin.kendaraan.edit', compact('kendaraan', 'kategori', 'selectedJenis', 'selectedKategori'));
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

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

        // Foto
        $fotoPath = $kendaraan->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }

            $fotoPath = $request->file('foto')->store('kendaraan', 'public');
        }

        $kendaraan->update([
            'id_kategori'    => $kategori->id,
            'merek'          => $request->merek,
            'nama_kendaraan' => $request->nama_kendaraan,
            'deskripsi'      => $request->deskripsi,
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
