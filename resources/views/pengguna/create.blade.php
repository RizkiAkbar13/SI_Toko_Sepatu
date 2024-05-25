@extends('template')
@section('title', 'Sistem Informasi Toko Sepatu | Pengguna')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Tambah Data Pengguna</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('pengguna') }}">Data Pengguna</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Data Pengguna</li>
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
                                <form class="form form-vertical" action="{{ route('pengguna.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Nama</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Nama" name="NAMA" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Alamat</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Alamat" name="ALAMAT" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Nomor Telepon</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Nomor Telepon" name="NO_TELP" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Username</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Username" name="USERNAME"required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Email</label>
                                                    <input type="email" id="email-id-vertical" class="form-control"
                                                        placeholder="Masukkan Email" name="EMAIL" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-info-vertical">Password</label>
                                                    <input type="text" id="email-id-vertical" class="form-control"
                                                        placeholder="Password" name="PASSWORD">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">Role</label>
                                                    <select class="form-control" name="ROLE" id="ROLE">
                                                        <option value="" selected>Pilih Role</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="kasir">Kasir</option>
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
