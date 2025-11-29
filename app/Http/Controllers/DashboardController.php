<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Rental;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Kendaraan
        $totalKendaraan = Kendaraan::count();

        // Kendaraan Tersedia
        $kendaraanTersedia = Kendaraan::where('status', 'Tersedia')->count();

        // Kendaraan Disewa
        $kendaraanDisewa = Kendaraan::where('status', 'Disewa')->count();

        // Kendaraan Perbaikan
        $kendaraanPerbaikan = Kendaraan::where('status', 'Perbaikan')->count();

        // Persentase Status
        $persentaseTersedia = $totalKendaraan > 0 ? round(($kendaraanTersedia / $totalKendaraan) * 100) : 0;
        $persentaseDisewa = $totalKendaraan > 0 ? round(($kendaraanDisewa / $totalKendaraan) * 100) : 0;
        $persentasePerbaikan = $totalKendaraan > 0 ? round(($kendaraanPerbaikan / $totalKendaraan) * 100) : 0;

        // Rental Aktif (bulan ini atau yang masih berlangsung)
        $rentalAktif = Rental::where('status_sewa', 'Aktif')->count();

        // Total Revenue Bulan Ini
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();
        
        $totalRevenue = Pembayaran::whereBetween('tanggal_bayar', [$firstDayOfMonth, $lastDayOfMonth])
            ->sum('jumlah_bayar');

        // Pembayaran Tertunda (rental sudah selesai tapi belum dibayar)
        $pembayaranTertunda = Rental::where('status_sewa', 'Selesai')
            ->whereDoesntHave('pembayaran')
            ->count();

        // Pembayaran Tertunda List (untuk ditampilkan)
        $pembayaranTertundaList = Rental::where('status_sewa', 'Selesai')
            ->whereDoesntHave('pembayaran')
            ->with(['user', 'kendaraan', 'pembayaran'])
            ->latest()
            ->take(5)
            ->get();

        // Total Users
        $totalUsers = User::where('role', 'customer')->count();

        // Kategori Populer (kategori yang paling sering disewa)
        $kategoriPopuler = DB::table('rental')
            ->join('kendaraan', 'rental.id_kendaraan', '=', 'kendaraan.id')
            ->join('kategori', 'kendaraan.id_kategori', '=', 'kategori.id')
            ->select('kategori.nama_kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori.id', 'kategori.nama_kategori')
            ->orderBy('total', 'desc')
            ->first()
            ?->nama_kategori ?? '-';

        // Rental Terbaru (5 rental terakhir)
        $rentalTerbaru = Rental::with(['user', 'kendaraan'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalKendaraan',
            'kendaraanTersedia',
            'kendaraanDisewa',
            'kendaraanPerbaikan',
            'persentaseTersedia',
            'persentaseDisewa',
            'persentasePerbaikan',
            'rentalAktif',
            'totalRevenue',
            'pembayaranTertunda',
            'pembayaranTertundaList',
            'totalUsers',
            'kategoriPopuler',
            'rentalTerbaru'
        ));
    }
}
