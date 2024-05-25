@extends('template')
@section('title', 'Sistem Informasi Toko Sepatu | Barang')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Barang</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('barang/create') }}"><button class="btn btn-success">Tambah Data</button></a>
                    @if (Auth::user()->ROLE == 'admin')
                        <a href="{{ url('export/barang') }}"><button class="btn btn-success">Export PDF</button></a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Nama Suplier</th>
                                <th>Alamat Suplier</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $barang)
                                <tr>
                                    <td>{{ $barang->NAMA_BARANG }}</td>
                                    <td>Rp{{ number_format($barang->HARGA, 0, ',', '.') }}</td>
                                    <td>{{ $barang->STOK }}</td>
                                    <td>{{ $barang->suplier->NAMA_SUPLIER }}</td>
                                    <td>{{ $barang->suplier->ALAMAT }}</td>
                                    <td>
                                        <a href="{{ route('barang.edit', $barang->ID_BARANG) }}"
                                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                            data-original-title="Edit Barang">
                                            <button class="btn btn-primary" type="button">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('barang.destroy', $barang->ID_BARANG) }}"
                                            class="btn btn-danger font-weight-bold text-xs" data-confirm-delete="true">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
