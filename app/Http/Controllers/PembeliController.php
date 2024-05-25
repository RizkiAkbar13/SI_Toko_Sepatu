<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pembeli::all();
        $title = 'Hapus Pembeli';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('pembeli/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembeli/create');
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
            'NAMA_PEMBELI' => 'required|string|max:255',
            'JK' => 'required|string|max:255',
            'ALAMAT' => 'required|string|max:255',
            'NO_TLP' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $pembeliData = $request->only(['NAMA_PEMBELI', 'JK', 'ALAMAT', 'NO_TLP']);
            pembeli::create($pembeliData);
            Alert::success("Success", "Data berhasil disimpan");
            DB::commit();
            return redirect("pembeli");
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
    public function edit(pembeli $pembeli)
    {
        return view('pembeli/edit', compact('pembeli'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pembeli $pembeli)
    {
        $validator = Validator::make($request->all(), [
            'NAMA_PEMBELI' => 'required|string|max:255',
            'JK' => 'required|string|max:255',
            'ALAMAT' => 'required|string|max:255',
            'NO_TLP' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $pembeli->NAMA_PEMBELI = $request->NAMA_PEMBELI;
            $pembeli->ALAMAT = $request->ALAMAT;
            $pembeli->JK = $request->JK;
            $pembeli->NO_TLP = $request->NO_TLP;
            $pembeli->save();
            DB::commit();
            Alert::success("Success", "Data berhasil diperbarui");
            return redirect("pembeli");
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
    public function destroy(pembeli $pembeli)
    {
        $pembeli->delete();
        Alert::success("Success", "Data berhasil dihapus");
        return redirect("pembeli");
    }

    public function export()
    {
        $pembeli = Pembeli::all();
        $pdf = Pdf::loadview('pembeli.export_pdf', ['data' => $pembeli]);
        return $pdf->download('laporan-pembeli.pdf');
    }
}
