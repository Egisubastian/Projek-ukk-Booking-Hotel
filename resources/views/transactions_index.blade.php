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
        <h3 class="card-title">Daftar Transaksi Produk</h3>
      </div>

      <div class="card-body">
      <form action="{{ route('transactions.index') }}" method="get">
      <div class="input-group">
      <input type="search" name="search" class="form-control" placeholder="Masukan Nama Produk/Tanggal" value="{{ $vcari }}">
      <button button type="submit" style="margin-left: 5px;" class="btn btn-primary">Cari</button>
      <a href="{{ url('transactions') }}"><button type="button" style="margin-left: 5px;" class="btn btn-danger">Reset</button></a>
      </div>
      </form>
      </div>

      <div class="card-body">
        @if($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif

        @if (in_array(Auth::user()->role, ['admin','kasir']))
        <a href="{{ route('transactions.create') }}" class="btn btn-success">Tambah Transaksi</a>
        <br><br>
        @endif

        @if (in_array(Auth::user()->role, ['owner','admin']))
<td style="text-align: center; vertical-align: middle;">
  <a href="{{ url('transactions/pdf') }}" class="btn btn-primary">Unduh PDF</a>
</td>
<br></br>
@endif

    <table class="table table-striped table-bordered">
<tr>
  <th style="text-align: center; vertical-align: middle;">Nomor Unik</th>
  <th style="text-align: center; vertical-align: middle;">Nama Pelanggan</th>
  <th style="text-align: center; vertical-align: middle;">Nama Produk</th>
  <th style="text-align: center; vertical-align: middle;">Harga Produk</th>
  <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
  <th style="text-align: center; vertical-align: middle;">Uang Kembali</th>
  <th style="text-align: center; vertical-align: middle;">Tanggal</th>
  @if (in_array(Auth::user()->role, ['admin', 'kasir']))
  <th style="text-align: center; vertical-align: middle;">Aksi</th>
  @endif

</tr>
@if(count($transactionsM) > 0)
@foreach ($transactionsM as $transactions)
<tr>
  <td style="text-align: center; vertical-align: middle;">{{ $transactions->nomor_unik}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $transactions->nama_pelanggan}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $transactions->nama_produk}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $transactions->harga_produk}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $transactions->uang_bayar}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $transactions->uang_kembali}}</td>
  <td style="text-align: center; vertical-align: middle;">{{ $transactions->created_at}}</td>

  @if (in_array(Auth::user()->role, ['admin', 'kasir']))
  <td style="text-align: center; vertical-align: middle;">
  <a href="{{ url('transactions/cetak', $transactions->id_trans) }}" class="btn btn-primary" style="display: inline-block; margin-left: 5px;">Print</a>
  @endif
  @if (in_array(Auth::user()->role, ['admin']))
  <a href="{{ route('transactions.edit', $transactions->id_trans) }}" class="btn btn-warning" style="margin-right: 5px;">Edit</a>
  <form action="{{ route('transactions.destroy', $transactions->id_trans) }}" method="POST" style="display: inline-block; margin-left: 5px; padding: 3px;">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Transaksi !?')">Hapus</button>
  </form>
</td>
@endif


</tr>
@endforeach
@else
<tr>
  <td colspan="8">Transaksi Tidak Ditemukan</td> 
</tr>
@endif
       </table>
      </div>
      </div>
  </section>
  <!-- /.content -->
@endsection