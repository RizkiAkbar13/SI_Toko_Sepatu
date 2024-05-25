<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::all();
        $title = 'Hapus Transaksi';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('transaksi/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        $pembeli = Pembeli::all();
        return view('transaksi/create', compact('barang', 'pembeli'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID_BARANG' => 'required',
            'ID_PEMBELI' => 'required',
            'ID_PENGGUNA' => 'required',
            'KETERANGAN' => 'required|string|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $transaksiData = $request->only(['ID_BARANG', 'ID_PEMBELI', 'ID_PENGGUNA', 'KETERANGAN']);
            Transaksi::create($transaksiData);
            Alert::success("Success", "Data berhasil disimpan");
            DB::commit();
            return redirect("transaksi");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $barang = Barang::all();
        $pembeli = Pembeli::all();
        return view('transaksi/edit', compact('transaksi', 'pembeli', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $validator = Validator::make($request->all(), [
            'ID_BARANG' => 'required',
            'ID_PEMBELI' => 'required',
            'ID_PENGGUNA' => 'required',
            'KETERANGAN' => 'required|string|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $transaksi->ID_BARANG = $request->ID_BARANG;
            $transaksi->ID_PEMBELI = $request->ID_PEMBELI;
            $transaksi->ID_PENGGUNA = $request->ID_PENGGUNA;
            $transaksi->KETERANGAN = $request->KETERANGAN;
            $transaksi->save();
            DB::commit();
            Alert::success("Success", "Data berhasil diperbarui");
            return redirect("transaksi");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        Alert::success("Success", "Data berhasil dihapus");
        return redirect("transaksi");
    }

    public function bayarTransaksi($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $barang = Barang::findOrFail($transaksi->ID_BARANG);
        $pembeli = Pembeli::findOrFail($transaksi->ID_PEMBELI);
        return view('pembayaran.create', compact('transaksi', 'barang', 'pembeli'));
    }

    public function cetakStruk($id)
    {
        $transaksi = Transaksi::join('pembayaran', 'pembayaran.ID_TRANSAKSI', 'transaksi.ID_TRANSAKSI')
            ->join('barang', 'barang.ID_BARANG', 'transaksi.ID_BARANG')
            ->join('pembeli', 'pembeli.ID_PEMBELI', 'transaksi.ID_PEMBELI')
            ->join('pengguna', 'pengguna.ID_PENGGUNA', 'transaksi.ID_PENGGUNA')
            ->select('transaksi.*', 'pembayaran.*', 'pembeli.*', 'pengguna.*', 'barang.*')
            ->where('pembayaran.ID_TRANSAKSI', $id)
            ->get();
        $pdf = Pdf::loadView('transaksi.receipt', compact('transaksi'));
        return $pdf->download('Struk Pembayaran.pdf');
    }

    public function export()
    {
        $transaksi = Transaksi::all();
        $pdf = Pdf::loadview('transaksi.export_pdf', ['data' => $transaksi]);
        return $pdf->download('laporan-transaksi.pdf');
    }
}
