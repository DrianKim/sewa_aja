<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use App\Models\Kendaraan;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HargaController extends Controller
{
    public function index()
    {
        $hargas = Harga::with(['kendaraan.kategori'])
            ->orderBy('tanggal_berlaku', 'desc')
            ->get();

        // Hitung statistik
        $totalHarga = $hargas->count();

        // Hitung kendaraan yang belum ada harga
        $totalKendaraan = \App\Models\Kendaraan::count();
        $kendaraanDenganHarga = $hargas->unique('id_kendaraan')->count();
        $belumAdaHarga = $totalKendaraan - $kendaraanDenganHarga;

        $hargaMobil = $hargas->filter(function ($harga) {
            return $harga->kendaraan->kategori->nama_kategori == 'Mobil';
        })->count();
        $hargaMotor = $hargas->filter(function ($harga) {
            return $harga->kendaraan->kategori->nama_kategori == 'Motor';
        })->count();

        $groupedHargas = $hargas->groupBy(function ($harga) {
            return $harga->kendaraan->kategori->nama_kategori ?? 'Tanpa Kategori';
        });

        return view('admin.harga.index', compact(
            'groupedHargas',
            'totalHarga',
            'belumAdaHarga',
            'hargaMobil',
            'hargaMotor'
        ));
    }

    public function create()
    {
        $kendaraanBelumAdaHarga = Kendaraan::whereDoesntHave('harga')
            ->with('kategori')
            ->get();

        return view('admin.harga.create', compact('kendaraanBelumAdaHarga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:kendaraan,id',
            'harga_perhari' => 'required|numeric|min:0',
            'tanggal_berlaku' => 'required|date'
        ]);

        try {
            Harga::create([
                'id_kendaraan' => $request->id_kendaraan,
                'harga_perhari' => $request->harga_perhari,
                'tanggal_berlaku' => $request->tanggal_berlaku
            ]);

            return redirect()->route('harga.index')
                ->with('success', 'Data harga berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $harga = Harga::with('kendaraan.kategori')->findOrFail($id);

        // Untuk edit, tampilkan semua kendaraan termasuk yang sudah ada harga
        $kendaraans = Kendaraan::with('kategori')->get();

        return view('admin.harga.edit', compact('harga', 'kendaraans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:kendaraan,id',
            'harga_perhari' => 'required|numeric|min:0',
            'tanggal_berlaku' => 'required|date'
        ]);

        try {
            $harga = Harga::findOrFail($id);
            $harga->update([
                'id_kendaraan' => $request->id_kendaraan,
                'harga_perhari' => $request->harga_perhari,
                'tanggal_berlaku' => $request->tanggal_berlaku
            ]);

            return redirect()->route('harga.index')
                ->with('success', 'Data harga berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $harga = Harga::findOrFail($id);
            $harga->delete();

            return redirect()->route('harga.index')
                ->with('success', 'Data harga berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
