@extends('template')
@section('title', 'Sistem Informasi Toko Sepatu | Transaksi')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data Transaksi</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('transaksi') }}">Data Transaksi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data Transaksi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical"
                                    action="{{ route('transaksi.update', $transaksi->ID_TRANSAKSI) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <input type="hidden" name="ID_PENGGUNA" value="{{ Auth::user()->ID_PENGGUNA }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Nama Barang</label>
                                                    <select class="form-control" name="ID_BARANG" id="ID_BARANG">
                                                        <option value="" selected>Pilih Barang</option>
                                                        @foreach ($barang as $k)
                                                            <option
                                                                {{ $k->ID_BARANG == $transaksi->ID_BARANG ? 'selected' : '' }}
                                                                value="{{ $k->ID_BARANG }}">
                                                                {{ $k->NAMA_BARANG }} x1 -
                                                                Rp{{ number_format($k->HARGA, 0, ',', '.') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Nama Pembeli</label>
                                                    <select class="form-control" name="ID_PEMBELI" id="ID_PEMBELI">
                                                        <option value="" selected>Pilih Suplier</option>
                                                        @foreach ($pembeli as $k)
                                                            <option
                                                                {{ $k->ID_PEMBELI == $transaksi->ID_PEMBELI ? 'selected' : '' }}
                                                                value="{{ $k->ID_PEMBELI }}">
                                                                {{ $k->NAMA_PEMBELI }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Keterangan</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Keterangan (beri tanda `-` jika tidak ada)"
                                                        name="KETERANGAN" value="{{ $transaksi->KETERANGAN }}" required>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
