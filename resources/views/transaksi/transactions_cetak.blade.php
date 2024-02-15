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
            padding: 20px;
        }

        .nota {
            margin-bottom: 20px;
        }

        .nota h1 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
            margin-top: -50px;
        }

        .nota-item {
            margin-bottom: 5px;
        }

        .nota-fasilitas {
            margin-bottom: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .nota-itemm {
            text-align: center;
            margin-bottom: 5px;
        }

        .item-label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        .dashed-line {
            border-top: 1px dashed #000;
            margin: 10px 0;
            width: 100%;
        }

        .thank-you {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }


        .nota-item span {
            font-size: 14px;
        }

        .footer {
            margin-top: 10px;
            text-align: right;
            font-size: 15px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    @foreach($transactionsM as $data)
    <div class="nota">
        <h1>Selamat datang di Hotel PesanAJA</h1>
        <br>
        <div class="nota-item">
            <span class="item-label">Kasir</span>: {{ Auth::user()->name }}
            <span>================================</span>
        </div>
        <div class="nota-item">
            <span class="item-label">Nomor Unik</span>: {{ $data->nomor_unik }}
        </div>
        <div class="nota-item">
            <span class="item-label">Pelanggan</span>: {{ $data->nama_pelanggan }}
        </div>

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
        <div class="nota-itemm">
            <span class="item-label">{{ $data->nama_produk }} </span> {{ number_format($data->harga_produk, 0, ',',
            '.') }}
        </div>
        <div class="nota-fasilitas">
            <span style="display: inline-block; width: 10%; text-align: center;"></span>
            {{ $data->fasilitas }}
        </div>

        <div class="dashed-line"></div>
        <div class="nota-item">
            <span class="item-label">Jumlah Hari</span> {{ $data->jumlah_hari }} Hari
        </div>
        <div class="nota-item">
            <span class="item-label">Total</span> {{ $data->total_harga }}
        </div>
        <div class="nota-item">
            <span class="item-label">Uang Bayar</span> {{ $data->uang_bayar }}
        </div>
        <div class="nota-item">
            <span class="item-label">Kembalian</span> {{ $data->uang_kembali }}
            <span>================================</span>
        </div>
        <div class="thank-you">
            Jl. Raya Kalijati Timur Rt/RW 21/07 Kec.Kalijati Timun Dusun Cibodas
        </div>
    </div>
    </div>
    @endforeach
</body>

</html>