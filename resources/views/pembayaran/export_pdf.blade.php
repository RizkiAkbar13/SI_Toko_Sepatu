<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembayaran</title>
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
        <h5 class="mb-2">Laporan Pembayaran</h5>
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
                <th>Nama Petugas</th>
                <th>Total Bayar</th>
                <th>Kembalian</th>
                <th>Tanggal Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $pembayaran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
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
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
