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
        $data_kendaraan = Kendaraan::with('kategori')->latest()->get();
        return view('admin.kendaraan.index', compact('data_kendaraan'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.kendaraan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama' => 'required|string|max:100',
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'no_plat' => 'required|unique:kendaraan,no_plat',
            'warna' => 'nullable|string|max:100',
            'transmisi' => 'required|in:Automatic,Manual',
            'kapasitas_penumpang' => 'nullable|integer|min:1',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'keterangan' => 'nullable|string',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('kendaraan', 'public');
        }

        Kendaraan::create([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'merk' => $request->merk,
            'model' => $request->model,
            'tahun' => $request->tahun,
            'no_plat' => $request->no_plat,
            'warna' => $request->warna,
            'transmisi' => $request->transmisi,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'foto' => $fotoPath,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan!');
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
            'kategori_id' => 'required|exists:kategori,id',
            'nama' => 'required|string|max:100',
            'merk' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'no_plat' => 'required|unique:kendaraan,no_plat,' . $kendaraan->id,
            'warna' => 'nullable|string|max:100',
            'transmisi' => 'required|in:Automatic,Manual',
            'kapasitas_penumpang' => 'nullable|integer|min:1',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            'keterangan' => 'nullable|string',
        ]);

        $fotoPath = $kendaraan->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('kendaraan', 'public');
        }

        $kendaraan->update([
            'kategori_id' => $request->kategori_id,
            'nama' => $request->nama,
            'merk' => $request->merk,
            'model' => $request->model,
            'tahun' => $request->tahun,
            'no_plat' => $request->no_plat,
            'warna' => $request->warna,
            'transmisi' => $request->transmisi,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'foto' => $fotoPath,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        if ($kendaraan->foto && Storage::disk('public')->exists($kendaraan->foto)) {
            Storage::disk('public')->delete($kendaraan->foto);
        }
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus!');
    }
}
