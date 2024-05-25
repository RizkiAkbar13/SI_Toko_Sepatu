<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Pembayaran;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pembayaran::all();
        $title = 'Hapus Histori Pembayaran';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('pembayaran/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'ID_TRANSAKSI' => 'required',
            'TOTAL_BAYAR' => 'required|integer',
            'KEMBALIAN' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $pembayaranData = $request->only(['ID_TRANSAKSI', 'TOTAL_BAYAR', 'KEMBALIAN']);
            Pembayaran::create($pembayaranData);
            $transaksi = Transaksi::findOrFail($request->ID_TRANSAKSI);
            $transaksi->STATUS = 'sudah_bayar';
            $transaksi->save();
            Alert::success("Success", "Data berhasil disimpan");
            DB::commit();
            return redirect("pembayaran");
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
    public function edit(Pembayaran $pembayaran)
    {
        $barang = Barang::all();
        $pembeli = Pembeli::all();
        return view('pembayaran/edit', compact('pembayaran', 'pembeli', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
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
            $pembayaran->ID_BARANG = $request->ID_BARANG;
            $pembayaran->ID_PEMBELI = $request->ID_PEMBELI;
            $pembayaran->ID_PENGGUNA = $request->ID_PENGGUNA;
            $pembayaran->KETERANGAN = $request->KETERANGAN;
            $pembayaran->save();
            DB::commit();
            Alert::success("Success", "Data berhasil diperbarui");
            return redirect("pembayaran");
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
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        Alert::success("Success", "Data berhasil dihapus");
        return redirect("pembayaran");
    }

    public function export()
    {
        $pembayaran = Pembayaran::all();
        $pdf = Pdf::loadview('pembayaran.export_pdf', ['data' => $pembayaran]);
        return $pdf->download('laporan-pembayaran.pdf');
    }
}
