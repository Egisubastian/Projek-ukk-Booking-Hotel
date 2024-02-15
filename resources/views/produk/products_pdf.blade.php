<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>

<body>
    <div class="container">
        <h1>Daftar List Kamar</h1>
        <table>
            <tr>
                <th>Nama Kamar</th>
                <th>Harga Kamar</th>
                <th>Fasilitas</th>
                <th>Tanggal</th>
            </tr>
            @if(count($productsM) > 0)
            <?php $totalHarga = 0; ?>
            @foreach ($productsM as $products)
            <tr>
                <td>{{ $products->nama_produk}}</td>
                <td>Rp {{ number_format($products->harga_produk, 0, ',', '.') }}</td>
                <td>{{ $products->fasilitas}}</td>
                <td>{{ $products->created_at }}</td>
            </tr>
            <?php $totalHarga += $products->harga_produk; ?>
            @endforeach
            <tr>
                <td colspan="4"><strong>Total Kamar:</strong> {{ count($productsM) }}</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;"><strong>Total Harga Kamar:</strong></td>
                <td>Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
            </tr>
            @else
            <tr>
                <td colspan="4">Data Kamar Tidak Ditemukan</td>
            </tr>
            @endif
        </table>
    </div>
</body>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .container {
        max-width: 800px;
        margin: auto;
    }

    h1 {
        font-family: 'Times New Roman', Times, serif;
        text-align: left;
        color: #333;
        margin-bottom: 20px;
        font-size: 15;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        font-size: 14px;
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
</style>

</html>