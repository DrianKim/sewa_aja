<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Rental;
use App\Models\Pembayaran;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // 9. Beranda Produk - Menampilkan daftar produk
    public function berandaProduk()
    {
        $kendaraan = Kendaraan::with(['kategori', 'harga'])
            ->where('status', 'tersedia')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $kategori = Kategori::all();

        return view('customer.dashboard-kendaraan', compact('kendaraan', 'kategori'));
    }

    // 10. Detail Produk - Menampilkan informasi produk
    public function detailProduk($id)
    {
        $kendaraan = Kendaraan::with(['kategori', 'harga'])
            ->findOrFail($id);

        return view('customer.detail-kendaraan', compact('kendaraan'));
    }

    // 11. Form Sewa - Menampilkan form sewa
    public function formSewa($id)
    {
        $kendaraan = Kendaraan::with('harga')->findOrFail($id);
        
        // Cek apakah kendaraan tersedia
        if ($kendaraan->status != 'tersedia') {
            return redirect()->back()->with('error', 'Kendaraan tidak tersedia untuk disewa');
        }

        return view('customer.rental', compact('kendaraan'));
    }

    // 11. Simpan Sewa - Menyimpan data sewa + validasi
    public function simpanSewa(Request $request)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:kendaraan,id',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'no_hp' => 'required|string|max:15',
            'alamat_jemput' => 'required|string|max:255'
        ]);

        try {
            $kendaraan = Kendaraan::findOrFail($request->id_kendaraan);
            
            // Hitung total harga
            $start = Carbon::parse($request->tanggal_mulai);
            $end = Carbon::parse($request->tanggal_selesai);
            $days = $start->diffInDays($end);
            $hargaPerHari = $kendaraan->harga->first()->harga_perhari;
            $totalHarga = $days * $hargaPerHari;

            // Buat data rental
            $rental = Rental::create([
                'id_user' => Auth::id(),
                'id_kendaraan' => $request->id_kendaraan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'total_harga' => $totalHarga,
                'status_sewa' => 'pending'
            ]);

            // Update user contact info jika berbeda
            $user = Auth::user();
            if ($user->no_hp != $request->no_hp) {
                $user->update(['no_hp' => $request->no_hp]);
            }

            return redirect()->route('customer.payment', $rental->id)
                ->with('success', 'Penyewaan berhasil dibuat. Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // 12. Riwayat Sewa - Menampilkan riwayat transaksi
    public function riwayatSewa()
    {
        $rentals = Rental::with(['kendaraan', 'pembayaran'])
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.riwayat-rental', compact('rentals'));
    }

    // 13. Pembayaran User - Menampilkan form pembayaran
    public function formPembayaran($id)
    {
        $rental = Rental::with(['kendaraan', 'user'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        // Cek status rental
        if ($rental->status_sewa != 'pending') {
            return redirect()->route('customer.history')
                ->with('error', 'Penyewaan sudah diproses atau dibatalkan');
        }

        return view('customer.pembayaran', compact('rental'));
    }

    // 13. Upload Bukti Pembayaran - Menyimpan bukti pembayaran
    public function uploadBuktiPembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'metode_pembayaran' => 'required|string'
        ]);

        try {
            $rental = Rental::where('id_user', Auth::id())
                ->findOrFail($id);

            // Upload bukti pembayaran
            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $filename = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('bukti_pembayaran', $filename, 'public');
                
                // Simpan data pembayaran
                Pembayaran::create([
                    'id_rental' => $rental->id,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'jumlah_bayar' => $rental->total_harga,
                    'tanggal_bayar' => now(),
                    'bukti_transfer' => $path // Tambahkan field ini di migration jika belum ada
                ]);

                // Update status rental
                $rental->update(['status_sewa' => 'menunggu_konfirmasi']);
            }

            return redirect()->route('customer.history')
                ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu konfirmasi admin.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // 14. Profil User - Menampilkan form profil
    public function profilUser()
    {
        $user = Auth::user();
        return view('customer.profil', compact('user'));
    }

    // 14. Update Profil - Mengupdate profil user
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:500',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:6|confirmed'
        ]);

        try {
            $data = [
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat
            ];

            // Update password jika diisi
            if ($request->filled('current_password') && $request->filled('new_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', 'Password saat ini salah');
                }
                
                $data['password'] = Hash::make($request->new_password);
            }

            $user->update($data);

            return redirect()->route('customer.profile')
                ->with('success', 'Profil berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Fitur tambahan: Batalkan Sewa
    public function batalkanSewa($id)
    {
        try {
            $rental = Rental::where('id_user', Auth::id())
                ->where('status_sewa', 'pending')
                ->findOrFail($id);

            $rental->update(['status_sewa' => 'dibatalkan']);

            return redirect()->route('customer.history')
                ->with('success', 'Penyewaan berhasil dibatalkan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Tidak dapat membatalkan penyewaan');
        }
    }

    // Fitur tambahan: Detail Riwayat
    public function detailRiwayat($id)
    {
        $rental = Rental::with(['kendaraan', 'pembayaran', 'detailPembayaran'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        return view('customer.history-detail', compact('rental'));
    }

    // Fitur tambahan: Filter Riwayat
    public function filterRiwayat(Request $request)
    {
        $status = $request->get('status');
        
        $query = Rental::with(['kendaraan', 'pembayaran'])
            ->where('id_user', Auth::id());

        if ($status && $status != 'semua') {
            $query->where('status_sewa', $status);
        }

        $rentals = $query->orderBy('created_at', 'desc')->get();

        return view('customer.riwayat-rental', compact('rentals'));
    }

    // Fitur tambahan: Cari Kendaraan
    public function cariKendaraan(Request $request)
    {
        $search = $request->get('search');
        $kategori = $request->get('kategori');

        $query = Kendaraan::with(['kategori', 'harga'])
            ->where('status', 'tersedia');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_kendaraan', 'like', "%$search%")
                  ->orWhere('merek', 'like', "%$search%");
            });
        }

        if ($kategori) {
            $query->whereHas('kategori', function($q) use ($kategori) {
                $q->where('id', $kategori);
            });
        }

        $kendaraan = $query->orderBy('created_at', 'desc')->get();
        $kategories = Kategori::all();

        return view('customer.dashboard-kendaraan', compact('kendaraan', 'kategories'));
    }
}