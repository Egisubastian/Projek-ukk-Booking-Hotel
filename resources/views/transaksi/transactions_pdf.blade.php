<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 10px; /* Adjust the font size as needed */
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

        td[colspan="10"] {
            text-align: center;
            font-style: italic;
            font-size: 10px; /* Adjust the font size as needed */
        }

        .summary {
            margin-top: 20px;
            background-color: #f2f2f2;
            padding: 12px;
            border-radius: 8px;
        }

        .summary p {
            margin: 5px 0;
            font-size: 12px;
            color: #333;
        }
    </style>
</head>

<body>
    <h1>Daftar Transaksi</h1>
    <table>
        <tr>
            <th>Nomor Unik</th>
            <th>Nama Pelanggan</th>
            <th>Nama Kamar</th>
            <th>Harga Kamar</th>
            <th>Uang Bayar</th>
            <th>Uang Kembali</th>
            <th>Tanggal Masuk</th>
            <th>Tanggal Keluar</th>
            <th>Pesan/hari</th>
            <th>Total Harga</th>
        </tr>
        @if(count($transactionsM) > 0)
        @foreach ($transactionsM as $transactions)
        <tr>
            <td>{{ $transactions->nomor_unik }}</td>
            <td>{{ $transactions->nama_pelanggan }}</td>
            <td>{{ $transactions->nama_produk }}</td>
            <td>Rp{{ $transactions->harga_produk }}</td>
            <td>Rp{{ $transactions->uang_bayar }}</td>
            <td>Rp{{ $transactions->uang_kembali }}</td>
            <td>{{ $transactions->tanggal_checkin }}</td>
            <td>{{ $transactions->tanggal_checkout }}</td>
            <td>{{ $transactions->jumlah_hari }} Hari</td>
            <td>Rp{{ $transactions->total_harga }}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="10">Transaksi Tidak Ditemukan</td>
        </tr>
        @endif
    </table>

    <?php
    $jumlahPelanggan = count($transactionsM);
    $jumlahProduk = count($transactionsM);
    $totalHargaProduk = 0;
    $totalUangBayar = 0;
    $totalUangKembali = 0;
    $totalHarga = 0;

    foreach ($transactionsM as $transactions) {
        $totalHargaProduk += $transactions->harga_produk;
        $totalUangBayar += $transactions->uang_bayar;
        $totalUangKembali += $transactions->uang_kembali;
        $totalHarga += $transactions->total_harga;
    }
    ?>

    <div class="summary">
        <h2>Ringkasan:</h2>
        <p>Jumlah Pelanggan: <strong>{{ $jumlahPelanggan }}</strong></p>
        <p>Jumlah Produk: <strong>{{ $jumlahProduk }}</strong></p>
        <p>Total Harga Produk: <strong>Rp{{ $totalHargaProduk }}</strong></p>
        <p>Total Harga: <strong>Rp{{ $totalHarga }}</strong></p>
        <p>Total Uang Bayar: <strong>Rp{{ $totalUangBayar }}</strong></p>
        <p>Total Uang Kembali: <strong>Rp{{ $totalUangKembali }}</strong></p>
    </div>

</body>

</html>
