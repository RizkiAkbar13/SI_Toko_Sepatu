<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Suplier;
use App\Models\TbFeedback;
use App\Models\TbPengaduan;
use App\Models\TbPetuga;
use App\Models\TbSiswa;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getTransaksiData()
    {
        $transaksiData = Transaksi::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $formattedData = [];
        for ($i = 1; $i <= 12; $i++) {
            $formattedData[] = $transaksiData[$i] ?? 0;
        }

        return response()->json($formattedData);
    }

    public function index()
    {
        $data['totalBarang'] = Barang::count();
        $data['totalPembeli'] = Pembeli::count();
        $data['totalTransaksi'] = Transaksi::count();
        $data['totalSuplier'] = Suplier::count();
        return view('dashboard', compact('data'));
    }
    public function indexUser()
    {
        return view('dashboard_user');
    }
    public function kontakPetugas()
    {
        $data = TbPetuga::all();
        return view('kontak_user', compact('data'));
    }
}
