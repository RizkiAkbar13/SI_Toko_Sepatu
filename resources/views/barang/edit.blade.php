@extends('template')
@section('title', 'Sistem Informasi Toko Sepatu | Barang')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Data Barang</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('barang') }}">Data Barang</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Data Barang</li>
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
                                <form class="form form-vertical" action="{{ route('barang.update', $barang->ID_BARANG) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Nama Barang</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Nama" name="NAMA_BARANG"
                                                        value="{{ $barang->NAMA_BARANG }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Harga</label>
                                                    <input type="number" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Harga" name="HARGA"
                                                        value="{{ $barang->HARGA }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Stok</label>
                                                    <input type="number" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Stok" name="STOK"
                                                        value="{{ $barang->STOK }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Suplier</label>
                                                    <select class="form-control" name="ID_SUPLIER" id="ID_SUPLIER">
                                                        <option value="" selected>Pilih Suplier</option>
                                                        @foreach ($data['suplier'] as $k)
                                                            <option
                                                                {{ $k->ID_SUPLIER == $data['suplierExist']->ID_SUPLIER ? 'selected' : '' }}
                                                                value="{{ $k->ID_SUPLIER }}">
                                                                {{ $k->NAMA_SUPLIER }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
