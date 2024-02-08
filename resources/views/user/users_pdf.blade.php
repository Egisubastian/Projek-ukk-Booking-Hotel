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

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 10px;
            /* Adjust the font size as needed */
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
            font-size: 10px;
            /* Adjust the font size as needed */
        }
    </style>
</head>

<body>
    <h1>Daftar Pengguna</h1>
    <table>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
        </tr>
        @forelse ($User as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->role }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Data Kamar Tidak Ditemukan</td>
            </tr>
        @endforelse
    </table>
</body>

</html>

<body>
    @foreach($transactionsM as $data)
    <div class="nota">
        <h1>
            <img src="dist/img/hotel.jpg" alt="Hotel Logo"> Hotel PesanAJA
            <!-- Replace "hotel-icon.png" with your actual image file -->
        </h1>
        <div class="dashed-line"></div>
        <div class="nota-item">
            <span class="item-label">Nomor Unik</span>: {{ $data->nomor_unik }}
        </div>
        <div class="nota-item">
            <span class="item-label">Nama Pelanggan</span>: {{ $data->nama_pelanggan }}
        </div>
        <div class="nota-item">
            <span class="item-label">Nama Produk</span>: {{ $data->nama_produk }}
        </div>
        <div class="nota-item">
            <span class="item-label">Fasilitas</span>: {{ $data->fasilitas }}
        </div>
        <div class="nota-item">
            <span class="item-label">Harga Produk</span>: {{ $data->harga_produk }}
        </div>
        <div class="nota-item">
            <span class="item-label">Jumlah Hari</span>: {{ $data->jumlah_hari }}
        </div>
        <div class="nota-item">
            <span class="item-label">Total Harga</span>: {{ $data->total_harga }}
        </div>
        <div class="nota-item">
            <span class="item-label">Uang Kembali</span>: {{ $data->uang_kembali }}
        </div>
        <div class="nota-item">
            <span class="item-label">Tanggal Check-in</span>: {{ $data->tanggal_checkin }}
        </div>
        <div class="nota-item">
            <span class="item-label">Tanggal Check-out</span>: {{ $data->tanggal_checkout }}
        </div>
        <div class="nota-item">
            <span class="item-label">Status</span>:{{ $data->checkout_status ? 'Sudah Checkout' : 'Belum Checkout' }}
        </div>
    </div>
    @endforeach
</body>