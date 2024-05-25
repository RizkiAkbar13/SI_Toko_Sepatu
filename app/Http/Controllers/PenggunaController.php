<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengguna::all();
        $title = 'Hapus Pengguna';
        $text = "Apakah anda yakin untuk hapus?";
        confirmDelete($title, $text);
        return view('pengguna/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna/create');
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
            'NAMA' => 'required|string|max:255',
            'ALAMAT' => 'required|string|max:255',
            'NO_TELP' => 'required|string|max:255',
            'USERNAME' => 'required|string|max:255',
            'EMAIL' => 'required|string|max:255',
            'PASSWORD' => 'required|string|max:255',
            'ROLE' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $penggunaData = $request->only(['NAMA', 'ALAMAT', 'NO_TELP', 'USERNAME', 'EMAIL', 'ROLE']);
            $penggunaData['PASSWORD'] = Hash::make($request->PASSWORD);
            Pengguna::create($penggunaData);
            Alert::success("Success", "Data berhasil disimpan");
            DB::commit();
            return redirect("pengguna");
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
    public function edit(Pengguna $pengguna)
    {
        return view('pengguna/edit', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengguna $pengguna)
    {
        $validator = Validator::make($request->all(), [
            'NAMA' => 'required|string|max:255',
            'ALAMAT' => 'required|string|max:255',
            'NO_TELP' => 'required|string|max:255',
            'USERNAME' => 'required|string|unique:pengguna,USERNAME,' . $pengguna->ID_PENGGUNA . ',ID_PENGGUNA',
            'EMAIL' => 'required|email|unique:pengguna,EMAIL,' . $pengguna->ID_PENGGUNA . ',ID_PENGGUNA',
            'password' => 'nullable|string|min:6',
            'ROLE' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try {
            $pengguna->NAMA = $request->NAMA;
            $pengguna->ALAMAT = $request->ALAMAT;
            $pengguna->NO_TELP = $request->NO_TELP;
            $pengguna->USERNAME = $request->USERNAME;
            $pengguna->EMAIL = $request->EMAIL;
            if ($request->filled('PASSWORD')) {
                $pengguna->PASSWORD = Hash::make($request->PASSWORD);
            }
            $pengguna->save();
            DB::commit();
            Alert::success("Success", "Data berhasil diperbarui");
            return redirect("pengguna");
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
    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        Alert::success("Success", "Data berhasil dihapus");
        return redirect("pengguna");
    }

    public function export()
    {
        $pengguna = Pengguna::all();
        $pdf = Pdf::loadview('pengguna.export_pdf', ['data' => $pengguna]);
        return $pdf->download('laporan-pengguna.pdf');
    }
}
