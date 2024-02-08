@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header" style="background-color: #f2f2f2; padding: 20px;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="color: #333; font-size: 24px;">Booking Hotel</h1>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color: transparent; margin-top: 5px;">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" style="color: #555;">Kamar</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Kamar</h3>
        </div>

        <div class="card-body">
    @if ($message = Session::get('success'))
        <div id="successAlert" class="alert alert-success">{{ $message }}</div>
    @endif

            @if (Auth::user()->role == 'admin')
            <a href="{{ route('products.create') }}" class="btn btn btn-outline-success" title="Tambah Kamar"
                onclick="return confirm('Apakah Anda yakin ingin menambahkan kamar baru?')">
                <i class="fas fa-plus custom-icon-color-green"></i> Tambah Data
            </a>
            @endif


            <a href="{{ url('products/pdf') }}" class="btn btnn btn-outline-info" title="Unduh Laporan PDF">
                <i class="fas fa-file-pdf custom-icon-color-blue"></i> Laporan PDF
            </a>

            <br>
            <br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-primary" id="myTable">
                    <thead class="thead-light" style="background-color: #3498db; color: #fff;">
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">ID</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Kamar</th>
                            <th style="text-align: center; vertical-align: middle;">Fasilitas</th>
                            <th style="text-align: center; vertical-align: middle;">Harga Kamar</th>
                            <th style="text-align: center; vertical-align: middle;">Status</th>
                            @if (Auth::user()->role == 'admin')
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($productsM) > 0)
                        @foreach ($productsM as $product)
                        <tr style="background-color: {{ $loop->index % 2 == 2? '#ffffff' : '#edf4ff' }}">
                            <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $product->nama_produk}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $product->fasilitas}}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ number_format($product->harga_produk, 0, ',', '.') }}
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                @if($product->status == 'available')
                                <span class="badge badge-success">Tersedia</span>
                                @else
                                <span class="badge badge-danger">Di Pesan</span>
                                @endif
                            </td>
                            @if (Auth::user()->role == 'admin')
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn btn-outline-warning"
                                    style="margin-right: 5px;" class="btn btn-edit mr-1" title="Edit"
                                    onclick="return confirm('Apakah Anda yakin ingin mengedit data ini?')">

                                    <i class="fas fa-edit custom-icon-color-yellow"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn btn-outline-danger" style="margin-left: 5px;"
                                        title="Hapus" onclick="return confirm('Konfirmasi Hapus Data !?')">
                                        <i class="fas fa-trash-alt custome-icon-color"></i>
                                    </button>
                                </form>
                            </td>

                            @endif
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">Data Tidak Ditemukan</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
        <script type="text/javascript">
            let table = new DataTable('#myTable');
        </script>

        <script>
             setTimeout(function() {
                        var errorAlert = document.getElementById('errorAlert');
                        if (errorAlert) {
                            errorAlert.classList.add('fade-out');
                            setTimeout(function() {
                                errorAlert.style.display = 'none'; 
                            }, 1000); 
                        }
                    }, 5000); //
                                 
                    setTimeout(function() {
                        var successAlert = document.getElementById('successAlert');
                        if (successAlert) {
                            successAlert.classList.add('fade-out'); 
                            setTimeout(function() {
                                successAlert.style.display = 'none'; 
                            }, 1000); 
                        }
                    }, 5000); 
        </script>

</section>
<style>
    .btn {
        border: 2px solid #21c500;
        transition: border-color 0.3s ease;
        border-radius: 4px;
    }

    .btnn {
        border: 2px solid #3366ff;
        transition: border-color 0.3s ease;
        border-radius: 4px;
    }
</style>
<style>
    .custome-icon-color {
        color: #ff0000;

    }

    .custom-icon-color-yellow {
        color: #cbd22e;
    }

    .custom-icon-color-green {
        color: #21c500;
    }

    .custom-icon-color-blue {
        color: #3366ff;
    }
</style>
@endsection

@section('active-menu-products', 'menu-open')
@section('active-products', 'active')