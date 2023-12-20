@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pet Shop Lontar</h1>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Produk</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('products.index') }}" method="get">
                <!-- <div class="input-group">
                <input type="search" name="search" class="form-control" placeholder="Masukan Nama Produk/Tanggal" value="{{ $vcari }}">
                <button button type="submit" style="margin-left: 5px;" class="btn btn-primary">Cari</button>
                <a href="{{ url('products') }}"><button type="button" style="margin-left: 5px;" class="btn btn-danger">Reset</button></a>
                </div> -->
            </form>
        </div>

        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            <a href="{{ url('products/pdf') }}" class="btn btn-warning">Unduh PDF</a>
            @if (Auth::user()->role == 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Data</a>
            <br><br>
            @endif

            <table class="table table-striped table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th style="text-align: center; vertical-align: middle;">Nama Produk</th>
                        <th style="text-align: center; vertical-align: middle;">Harga Produk</th>

                        @if (Auth::user()->role == 'admin')
                        <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @if(count($productsM) > 0)
                    @foreach ($productsM as $products)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">{{ $products->nama_produk}}</td>
                        <td style="text-align: center; vertical-align: middle;">{{ $products->harga_produk}}</td>

                        @if (Auth::user()->role == 'admin')
                        <td style="text-align: center; vertical-align: middle;">
                            <a href="{{ route('products.edit', $products->id) }}" class="btn btn-warning"
                                style="margin-right: 5px;">Edit</a>
                            <form action="{{ route('products.destroy', $products->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" style="margin-left: 5px;"
                                    onclick="return confirm('Konfirmasi Hapus Data !?')">Hapus</button>
                            </form>
                        </td>
                        @endif

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4">Data Tidak Ditemukan</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    <script type= "text/javascript">
                    let table = new DataTable('#myTable');
                </script>

</section>
<!-- /.content -->
@endsection
