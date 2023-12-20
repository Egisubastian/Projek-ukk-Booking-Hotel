<!DOCTYPE html>
<html>
<head>
    <title>Produk</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <table witdh="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
        <th style="text-align: center; vertical-align: middle;">Nama Produk</th>
        <th style="text-align: center; vertical-align: middle;">Harga Produk</th>
        <th style="text-align: center; vertical-align: middle;">Tanggal</th>
        </tr>
        @if(count($productsM) > 0)
        @foreach ($productsM as $products)
        <tr>
        <td style="text-align: center; vertical-align: middle;">{{ $products->nama_produk}}</td>
        <td style="text-align: center; vertical-align: middle;">{{ $products->harga_produk}}</td>
        <td style="text-align: center; vertical-align: middle;">{{ $products->created_at }}</td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="3">Transaksi Tidak Ditemukan</td>
        </tr>
        @endif
    </table>
</body>
</html>
