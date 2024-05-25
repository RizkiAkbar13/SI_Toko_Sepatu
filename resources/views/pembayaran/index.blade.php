@extends('template')
@section('title', 'Sistem Informasi Toko Sepatu | Pembayaran')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Histori Pembayaran</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Histori Pembayaran</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->ROLE == 'admin')
                        <a href="{{ url('export/pembayaran') }}"><button class="btn btn-success">Export PDF</button></a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Nama Pembeli</th>
                                <th>Nama Petugas</th>
                                <th>Total Bayar</th>
                                <th>Kembalian</th>
                                <th>Tanggal Bayar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $pembayaran)
                                <tr>
                                    <td>{{ $pembayaran->transaksi->barang->NAMA_BARANG }}</td>
                                    <td>Rp{{ number_format($pembayaran->transaksi->barang->HARGA, 0, ',', '.') }}</td>
                                    <td>{{ $pembayaran->transaksi->pembeli->NAMA_PEMBELI }} -
                                        {{ $pembayaran->transaksi->pembeli->NO_TLP }}</td>
                                    <td>{{ $pembayaran->transaksi->pengguna->NAMA }}</td>
                                    <td>Rp{{ number_format($pembayaran->TOTAL_BAYAR, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($pembayaran->KEMBALIAN, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pembayaran->created_at)->isoFormat('D MMMM YYYY HH:mm:ss') }}
                                    </td>
                                    <td>{{ $pembayaran->transaksi->STATUS == 'belum_bayar' ? 'Belum Bayar' : 'Sudah Bayar' }}
                                    </td>
                                    <td>
                                        @if ($pembayaran->transaksi->STATUS == 'sudah_bayar')
                                            <a href="{{ url('transaksi/cetak/' . $pembayaran->ID_TRANSAKSI) }}"
                                                class="btn btn-success font-weight-bold text-xs">
                                                Cetak Struk
                                            </a>
                                        @else
                                            <a href="{{ route('pembayaran.destroy', $pembayaran->ID_TRANSAKSI) }}"
                                                class="btn btn-danger font-weight-bold text-xs" data-confirm-delete="true">
                                                Delete
                                            </a>
                                        @endif

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
