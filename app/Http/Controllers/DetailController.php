<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index()
    {
        $details = Detail::with('kendaraan')->latest()->paginate(10);
        return view('admin.detail.index', compact('details'));
    }

    public function create()
    {
        $kendaraans = Kendaraan::all();
        return view('admin.detail.create', compact('kendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id|unique:detail,kendaraan_id',
            'harga_per_hari' => 'required|numeric|min:0',
            'harga_per_minggu' => 'nullable|numeric|min:0',
            'harga_per_bulan' => 'nullable|numeric|min:0',
            'harga_per_tahun' => 'nullable|numeric|min:0',
            'status' => 'required|in:tersedia,tidak_tersedia,pending,disewa',
        ], [
            'kendaraan_id.unique' => 'Detail untuk kendaraan ini sudah ada!',
        ]);

        Detail::create($request->all());

        return redirect()->route('detail.index')->with('success', 'Detail kendaraan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $detail = Detail::findOrFail($id);
        $kendaraans = Kendaraan::all();
        return view('admin.detail.edit', compact('detail', 'kendaraans'));
    }

    public function update(Request $request, $id)
    {
        $detail = Detail::findOrFail($id);

        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id|unique:detail,kendaraan_id,' . $id,
            'harga_per_hari' => 'required|numeric|min:0',
            'harga_per_minggu' => 'nullable|numeric|min:0',
            'harga_per_bulan' => 'nullable|numeric|min:0',
            'harga_per_tahun' => 'nullable|numeric|min:0',
            'status' => 'required|in:tersedia,tidak_tersedia,pending,disewa',
        ]);

        $detail->update($request->all());

        return redirect()->route('detail.index')->with('success', 'Detail kendaraan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $detail = Detail::findOrFail($id);
        $detail->delete();

        return redirect()->route('detail.index')->with('success', 'Detail kendaraan berhasil dihapus!');
    }
}
