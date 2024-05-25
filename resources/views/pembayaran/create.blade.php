@extends('template')
@section('title', 'Sistem Informasi Toko Sepatu | Pembayaran')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lakukan Pembayaran</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('transaksi') }}">Data Transaksi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lakukan Pembayaran</li>
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
                            <div class="card-header">
                                <h5>Detail Transaksi Anda</h5>
                            </div>
                            <div class="card-body">
                                <form class="form form-vertical" action="{{ route('pembayaran.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="ID_TRANSAKSI" value="{{ $transaksi->ID_TRANSAKSI }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Nama Barang</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        value="{{ $barang->NAMA_BARANG }}" name="NAMA_BARANG" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Harga</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        value="Rp{{ number_format($barang->HARGA, 0, ',', '.') }}"
                                                        name="NAMA_BARANG" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Nama Pembeli</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        value="{{ $pembeli->NAMA_PEMBELI }}" name="NAMA_PEMBELI" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Total Bayar</label>
                                                    <input type="number" id="total-bayar" class="form-control"
                                                        placeholder="Masukkan Nominal Pembayaran" name="TOTAL_BAYAR"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="change">Kembalian</label>
                                                    <input type="text" id="change" name="KEMBALIAN" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1"
                                                    id="submit-btn">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const totalBayarInput = document.getElementById('total-bayar');
                                        const changeInput = document.getElementById('change');
                                        const submitButton = document.getElementById('submit-btn');
                                        const hargaBarang = {{ $barang->HARGA }};

                                        totalBayarInput.addEventListener('input', function() {
                                            const totalBayar = parseInt(totalBayarInput.value);
                                            if (!isNaN(totalBayar)) {
                                                if (totalBayar >= hargaBarang) {
                                                    const change = totalBayar - hargaBarang;
                                                    changeInput.value = change;
                                                    submitButton.disabled = false;
                                                } else {
                                                    changeInput.value = 'Pembayaran kurang';
                                                    submitButton.disabled = true;
                                                }
                                            } else {
                                                changeInput.value = '';
                                                submitButton.disabled = true;
                                            }
                                        });
                                        submitButton.disabled = true;
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
