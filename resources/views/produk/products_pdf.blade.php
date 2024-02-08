<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>

<body>
    <h1>Daftar Kamar</h1>
    <table>
        <tr>
            <th>Nama Kamar</th>
            <th>Harga Kamar</th>
            <th>Fasilitas</th>
            <th>Tanggal</th>
        </tr>
        @if(count($productsM) > 0)
        @foreach ($productsM as $products)
        <tr>
            <td>{{ $products->nama_produk}}</td>
            <td>Rp{{ $products->harga_produk}}</td>
            <td>{{ $products->fasilitas}}</td>
            <td>{{ $products->created_at }}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4">Data Kamar Tidak Ditemukan</td>
        </tr>
        @endif
    </table>

    <?php
    $totalKamar = count($productsM);
    $totalHarga = 0;

    foreach ($productsM as $products) {
        $totalHarga += $products->harga_produk;
    }
    ?>

    <div class="summary">
        <h2>Ringkasan:</h2>
        <p>Jumlah kamar: <strong>{{ $totalKamar }}</strong></p>
        <p>Total Harga Kamar: <strong>Rp{{ $totalHarga }}</strong></p>
    </div>

</body>

<style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        td[colspan="4"] {
            text-align: center;
            font-style: italic;
            font-size: 14px;
            color: #555;
        }

        .summary {
            margin-top: 20px;
            background-color: #f2f2f2;
            padding: 12px;
            border-radius: 8px;
        }

        .summary p {
            margin: 5px 0;
            font-size: 14px;
            color: #333;
        }
    </style>
</html>
