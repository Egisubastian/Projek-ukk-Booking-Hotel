@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Booking Hotel</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Tambah Kamar</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Data Kamar</h3>
    </div>
    <div class="card-body">

      <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Nama Kamar</label>
          <input name="nama_produk" type="text" class="form-control" placeholder="...">
          @error('nama_produk')
          <p>{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <label>Fasilitas</label>
          <input name="fasilitas" type="text" class="form-control" placeholder="...">
          @error('fasilitas')
          <p>{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <label>Harga Kamar</label>
          <input name="harga_produk" type="number" class="form-control" placeholder="...">
          @error('harga_produk')
          <p>{{ $message }}</p>
          @enderror
        </div>

        <a href="{{ route('products.index') }}" class="btn btnn btn-outline-secondary">
          <i class="fas fa-arrow-left custome-icon-color "> </i> Kembali
        </a>
        
        <button type="submit" name="submit" class="btn btn-outline-success">
          <i class="fas fa-plus custom-icon-color-green"></i> Tambah
        </button>

      </form>
    </div>
  </div>
  <!-- /.card -->

</section>
<style>
  .btn {
    border: 2px solid #21c500;
    /* Warna hijau cerah dan ketebalan stroke */
    transition: border-color 0.3s ease;
    /* Efek transisi untuk perubahan warna */
    border-radius: 4px;
    /* Pemberian sudut pada border (opsional) */
  }

  .btnn {
        border: 2px solid #666666;
        transition: border-color 0.3s ease;
        border-radius: 4px;
    }
</style>

<style>
  .custome-icon-color {
    color: #ff0000;

  }

  .custom-icon-color-green {
    color: #21c500;
  }
</style>
@endsection
@section('active-menu-products', 'menu-open')
@section('active-products', 'active')