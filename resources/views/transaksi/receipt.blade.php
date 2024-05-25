<!DOCTYPE html>
<html>

<head>
    <title>Struk Pembelian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .container {
            margin: 0 auto;
            padding: 50px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 class="title">Struk Pembelian</h2>
            <h3 class="subtitle">Tanggal: {{ date('d F Y', strtotime($transaksi->first()->created_at)) }}</h3>
        </div>
        <div class="mb-4">
            <div class="mb-2">Nama Pembeli: {{ $transaksi->first()->NAMA_PEMBELI }}</div>
            <div class="mb-2">Kasir: {{ $transaksi->first()->NAMA }}</div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->NAMA_BARANG }}</td>
                        <td>Rp{{ number_format($item->HARGA, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row mt-4">
            <div class="col-12">
                <div class="mb-2">Total Pembelian:
                    <span class="total">Rp{{ number_format($transaksi->sum('HARGA'), 0, ',', '.') }}</span>
                </div>
                <div class="mb-2">Total Bayar:
                    <span class="total">Rp{{ number_format($transaksi->first()->TOTAL_BAYAR, 0, ',', '.') }}</span>
                </div>
                <div class="mb-2">Kembalian:
                    <span class="total">Rp{{ number_format($transaksi->first()->KEMBALIAN, 0, ',', '.') }}</span>
                </div>
            </div>

        </div>
        <div class="footer mt-4">
            <p><cite>Terima Kasih telah Berbelanja Di Toko Kami</cite></p>
        </div>
    </div>
</body>

</html>
