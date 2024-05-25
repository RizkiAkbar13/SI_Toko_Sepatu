<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang</title>
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
        <h5 class="mb-2">Laporan Barang</h5>
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
                <th>Stok</th>
                <th>Nama Suplier</th>
                <th>Alamat Suplier</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $barang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $barang->NAMA_BARANG }}</td>
                    <td>Rp{{ number_format($barang->HARGA, 0, ',', '.') }}</td>
                    <td>{{ $barang->STOK }}</td>
                    <td>{{ $barang->suplier->NAMA_SUPLIER }}</td>
                    <td>{{ $barang->suplier->ALAMAT }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
