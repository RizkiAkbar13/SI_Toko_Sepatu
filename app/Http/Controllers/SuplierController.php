<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Suplier::all();
        $title = 'Hapus Suplier';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('suplier/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suplier/create');
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
            'NAMA_SUPLIER' => 'required|string|max:255',
            'ALAMAT' => 'required|string|max:255',
            'NO_TLP' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $suplierData = $request->only(['NAMA_SUPLIER', 'ALAMAT', 'NO_TLP']);
            Suplier::create($suplierData);
            Alert::success("Success", "Data berhasil disimpan");
            DB::commit();
            return redirect("suplier");
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
    public function edit(Suplier $suplier)
    {
        return view('suplier/edit', compact('suplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suplier $suplier)
    {
        $validator = Validator::make($request->all(), [
            'NAMA_SUPLIER' => 'required|string|max:255',
            'ALAMAT' => 'required|string|max:255',
            'NO_TLP' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $suplier->NAMA_SUPLIER = $request->NAMA_SUPLIER;
            $suplier->ALAMAT = $request->ALAMAT;
            $suplier->NO_TLP = $request->NO_TLP;
            $suplier->save();
            DB::commit();
            Alert::success("Success", "Data berhasil diperbarui");
            return redirect("suplier");
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
    public function destroy(Suplier $suplier)
    {
        $suplier->delete();
        Alert::success("Success", "Data berhasil dihapus");
        return redirect("suplier");
    }

    public function export()
    {
        $suplier = Suplier::all();
        $pdf = Pdf::loadview('suplier.export_pdf', ['data' => $suplier]);
        return $pdf->download('laporan-suplier.pdf');
    }
}
