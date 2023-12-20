@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pet Shop Lontar</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit Data Transaksi</h3>

      </div>
      <div class="card-body">
        <a href="{{ route('transactions.index') }}" 
        class="btn btn-default">Kembali</a>
        <br><br>
        
        <form action="{{ route('transactions.update', $transactions->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="">Nomor Unik</label>
                <input name="nomor_unik" type="number" class="form-control" placeholder="..." value="{{ $transactions->nomor_unik }}" readonly>
                @error('nomor_unik')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Nama Pelanggan</label>
                <input name="nama_pelanggan" type="text" class="form-control" placeholder="..." value="{{ $transactions->nama_pelanggan }}">
                @error('nama_pelanggan')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Nama Produk + Harga</label>
                <select name="id_produk" class="form-control" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($productsM as $data)
                    <?php
                    if ($data->id == $transactions->id_produk):
                        $selected = "selected";
                    else:
                        $selected = "";
                    endif;
                    ?>
                    <option {{ $selected }} value="{{ $data->id }}">
                        {{ $data->nama_produk }} - {{$data->harga_produk}}
                    </option>
                    @endforeach
                </select>
                @error('id_produk')
                <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Uang Bayar</label>
                <input name="uang_bayar" type="tect" class="form-control" placeholder="..." value="{{ $transactions->uang_bayar }}">
                @error('uang_bayar')
                <p>{{ $message }}</p>
                @enderror
            </div>

            

            <input type="submit" name="submit" class="btn btn-primary" value="Ubah">

        </form>
      </div>
      <!-- /.card-body -->
      
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection