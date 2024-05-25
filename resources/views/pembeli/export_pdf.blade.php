<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembeli</title>
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
        <h5 class="mb-2">Laporan Pembeli</h5>
    </center>
    <div class="printed-date">
        Dicetak pada tanggal: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
    </div>
    <table class='table table-bordered table-striped'>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pembeli</th>
                <th>Jenis Kelamin</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $pembeli)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pembeli->NAMA_PEMBELI }}</td>
                    <td>{{ $pembeli->JK }}</td>
                    <td>{{ $pembeli->NO_TLP }}</td>
                    <td>{{ $pembeli->ALAMAT }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
