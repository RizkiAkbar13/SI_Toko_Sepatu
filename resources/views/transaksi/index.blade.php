@extends('template')
@section('title', 'Sistem Informasi Toko Sepatu | Transaksi')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Transaksi</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Transaksi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('transaksi/create') }}"><button class="btn btn-success">Tambah Data</button></a>
                    @if (Auth::user()->ROLE == 'admin')
                        <a href="{{ url('export/transaksi') }}"><button class="btn btn-success">Export PDF</button></a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Nama Pembeli</th>
                                <th>Nomor Telp</th>
                                <th>Nama Petugas</th>
                                <th>Keterangan</th>
                                <th>Tanggal Transaksi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->barang->NAMA_BARANG }}</td>
                                    <td>Rp{{ number_format($transaksi->barang->HARGA, 0, ',', '.') }}</td>
                                    <td>{{ $transaksi->pembeli->NAMA_PEMBELI }}</td>
                                    <td>{{ $transaksi->pembeli->NO_TLP }}</td>
                                    <td>{{ $transaksi->pengguna->NAMA }}</td>
                                    <td>{{ $transaksi->KETERANGAN }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->isoFormat('D MMMM YYYY HH:mm:ss') }}
                                    </td>
                                    <td>{{ $transaksi->STATUS == 'belum_bayar' ? 'Belum Bayar' : 'Sudah Bayar' }}</td>
                                    <td>

                                        @if ($transaksi->STATUS != 'sudah_bayar')
                                            <a href="{{ route('transaksi.edit', $transaksi->ID_TRANSAKSI) }}"
                                                class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Edit Transaksi">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                            </a>
                                            <a href="{{ url('transaksi/bayar/' . $transaksi->ID_TRANSAKSI) }}"
                                                class="btn btn-success font-weight-bold text-xs" data-toggle="tooltip"
                                                data-original-title="Bayar Transaksi">
                                                Bayar
                                            </a>
                                            <a href="{{ route('transaksi.destroy', $transaksi->ID_TRANSAKSI) }}"
                                                class="btn btn-danger font-weight-bold text-xs" data-confirm-delete="true">
                                                Delete
                                            </a>
                                        @else
                                            <a href="{{ url('transaksi/cetak/' . $transaksi->ID_TRANSAKSI) }}"
                                                class="btn btn-success font-weight-bold text-xs">
                                                Cetak Struk
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
