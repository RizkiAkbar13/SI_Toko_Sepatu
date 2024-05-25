@extends('template')
@section('title', 'Sistem Informasi Toko Sepatu | Pembeli')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pembeli</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pembeli</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('pembeli/create') }}"><button class="btn btn-success">Tambah Data</button></a>
                    @if (Auth::user()->ROLE == 'admin')
                        <a href="{{ url('export/pembeli') }}"><button class="btn btn-success">Export PDF</button></a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Nama Pembeli</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $pembeli)
                                <tr>
                                    <td>{{ $pembeli->NAMA_PEMBELI }}</td>
                                    <td>{{ $pembeli->JK }}</td>
                                    <td>{{ $pembeli->NO_TLP }}</td>
                                    <td>{{ $pembeli->ALAMAT }}</td>
                                    <td>
                                        <a href="{{ route('pembeli.edit', $pembeli->ID_PEMBELI) }}"
                                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                            data-original-title="Edit Pembeli">
                                            <button class="btn btn-primary" type="button">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('pembeli.destroy', $pembeli->ID_PEMBELI) }}"
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
