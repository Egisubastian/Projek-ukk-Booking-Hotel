<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;

        }

        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            padding: 6px;
            font-size: 12px;
            text-align: center;
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
            font-size: 14px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daftar List Transaksi</h1>
        <table>
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
            <?php $totalHarga = 0; ?>
            @foreach ($transactionsM as $transactions)
            <tr>
                <td>{{ $transactions->nomor_unik }}</td>
                <td>{{ $transactions->nama_pelanggan }}</td>
                <td>{{ $transactions->nama_produk }}</td>
                <td>Rp {{ number_format($transactions->harga_produk, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($transactions->uang_bayar, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($transactions->uang_kembali, 0, ',', '.') }}</td>
                <td>{{ $transactions->tanggal_checkin }}</td>
                <td>{{ $transactions->tanggal_checkout }}</td>
                <td>{{ $transactions->jumlah_hari }} Hari</td>
                <td>Rp{{ number_format($transactions->total_harga, 0, ',', '.') }}</td>
            </tr>
            <?php $totalHarga += $transactions->total_harga; ?>
            @endforeach
            <tr>
                <td colspan="10"><strong>Jumlah Transaksi:</strong> {{ count($transactionsM) }}</td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right;"><strong>Total Harga Produk:</strong> </td>
                <td colspan="2"> Rp {{ number_format($totalHargaProduk, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right;"><strong>Total Harga:</strong> </td>
                <td colspan="2"> Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right;"><strong>Total Bayar:</strong> </td>
                <td colspan="2"> Rp {{ number_format($totalUangBayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right;"><strong>Total Uang Kembali:</strong> </td>
                <td colspan="2"> Rp {{ number_format($totalUangKembali, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="8" style="text-align: right;"><strong>Total Pendapatan:</strong> </td>
                <td colspan="2"> Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
            </tr>

            @else
            <tr>
                <td colspan="4">Transaksi Tidak Ditemukan</td>
            </tr>
            @endif

        </table>
    </div>
</body>

</html>