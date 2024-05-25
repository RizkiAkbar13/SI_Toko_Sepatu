<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Suplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::all();
        $title = 'Hapus Barang';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('barang/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suplier = Suplier::all();
        return view('barang/create', compact('suplier'));
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
            'NAMA_BARANG' => 'required|string|max:255',
            'HARGA' => 'required|integer',
            'STOK' => 'required|integer',
            'ID_SUPLIER' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $barangData = $request->only(['NAMA_BARANG', 'HARGA', 'STOK', 'ID_SUPLIER']);
            Barang::create($barangData);
            Alert::success("Success", "Data berhasil disimpan");
            DB::commit();
            return redirect("barang");
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
    public function edit(Barang $barang)
    {
        $data["suplierExist"] = Suplier::find($barang->ID_SUPLIER);
        $data['suplier'] = Suplier::all();
        return view('barang/edit', compact('barang', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'NAMA_BARANG' => 'required|string|max:255',
            'HARGA' => 'required|integer',
            'STOK' => 'required|integer',
            'ID_SUPLIER' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $barang->NAMA_BARANG = $request->NAMA_BARANG;
            $barang->HARGA = $request->HARGA;
            $barang->STOK = $request->STOK;
            $barang->ID_SUPLIER = $request->ID_SUPLIER;
            $barang->save();
            DB::commit();
            Alert::success("Success", "Data berhasil diperbarui");
            return redirect("barang");
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
    public function destroy(Barang $barang)
    {
        DB::beginTransaction();
        try {
            $barang->delete();
            DB::commit();
            Alert::success("Success", "Data berhasil dihapus");
            return redirect("barang");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function export()
    {
        $barang = Barang::all();
        $pdf = Pdf::loadview('barang.export_pdf', ['data' => $barang]);
        return $pdf->download('laporan-barang.pdf');
    }
}
