<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .table th,
        .table td {
            font-size: 9pt;
        }

        .table thead th {
            color: #000;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
        }

        h5 {
            font-size: 16pt;
            margin-bottom: 5px;
        }

        .table {
            margin-top: 20px;
        }

        .printed-date {
            font-size: 9pt;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <center>
        <h5 class="mb-2">Laporan Transaksi</h5>
    </center>
    <div class="printed-date">
        Dicetak pada tanggal: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
    </div>
    <table class='table table-bordered table-striped'>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Nama Pembeli</th>
                <th>Nomor Telp</th>
                <th>Nama Petugas</th>
                <th>Keterangan</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->barang->NAMA_BARANG }}</td>
                    <td>Rp{{ number_format($transaksi->barang->HARGA, 0, ',', '.') }}</td>
                    <td>{{ $transaksi->pembeli->NAMA_PEMBELI }}</td>
                    <td>{{ $transaksi->pembeli->NO_TLP }}</td>
                    <td>{{ $transaksi->pengguna->NAMA }}</td>
                    <td>{{ $transaksi->KETERANGAN }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->isoFormat('D MMMM YYYY HH:mm:ss') }}
                    </td>
                    <td>{{ $transaksi->STATUS == 'belum_bayar' ? 'Belum Bayar' : 'Sudah Bayar' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
