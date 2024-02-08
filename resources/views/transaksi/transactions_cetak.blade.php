<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Booking Hotel</title>
    <style>
        body {
            font-family: "Courier New", monospace;
            text-align: left;
        }

        .nota {
            width: 70%;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 20px;
        }

        .nota h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .nota-item {
            margin-bottom: 10px;
        }

        .item-label {
            display: inline-block;
            width: 120px;
        }

        .dashed-line {
            border-top: 1px dashed #000;
            margin: 10px 0;
            width: 100%;
        }

        .thank-you {
            text-align: center;
            font-size: 16px;
            margin-top: 20px;
        }

        /* Perubahan pada Nomor sampai Tanggal */
        .nota-item span {
            font-size: 14px;
        }

        .nota-item span.item-label {
            width: 100px; /* Mengurangi lebar agar muat di layout */
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>

<body>
    @foreach($transactionsM as $data)
    <div class="nota">
        <h1>Selamat datang di Hotel PesanAJA</h1>

        <div class="dashed-line"></div>
        <div class="nota-item">
            <span class="item-label">Nomor Unik</span>: {{ $data->nomor_unik }}
        </div>
        <div class="nota-item">
            <span class="item-label">Pelanggan</span>: {{ $data->nama_pelanggan }}
        </div>
        <div class="nota-item">
            <span class="item-label">Produk</span>: {{ $data->nama_produk }}
        </div>
        <div class="nota-item">
            <span class="item-label">Fasilitas</span>: {{ $data->fasilitas }}
        </div>
        <div class="nota-item">
            <span class="item-label">Harga</span>: {{ $data->harga_produk }}
        </div>
        <div class="dashed-line"></div>
        <div class="nota-item">
            <span class="item-label">Jumlah Hari</span>: {{ $data->jumlah_hari }} Hari
        </div>
        <div class="nota-item">
            <span class="item-label">Total</span>: {{ $data->total_harga }}
        </div>
        <div class="nota-item">
            <span class="item-label">Uang Bayar</span>: {{ $data->uang_bayar }}
        </div>
        <div class="nota-item">
            <span class="item-label">Kembalian</span>: {{ $data->uang_kembali }}
        </div>
        <div class="dashed-line"></div>
        <div class="nota-item">
            <span class="item-label">Check-in</span>: {{ $data->tanggal_checkin }}
        </div>
        <div class="nota-item">
            <span class="item-label">Check-out</span>: {{ $data->tanggal_checkout }}
        </div>
        <div class="nota-item">
            <span class="item-label">Status</span>: {{ $data->checkout_status ? 'Sudah Checkout' : 'Belum Checkout' }}
        </div>
        <div class="dashed-line"></div>
        <div class="footer">
            Terima kasih atas kunjungan Anda. Have a nice day!
        </div>
    </div>
    @endforeach
</body>

</html>
