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
                    <li class="breadcrumb-item active">Pengguna</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card elevation-2">
        <div class="card-header">
            <h3 class="card-title">Ubah Kata Sandi Pengguna</h3>
        </div>
        <div class="card-body">

            <form action="{{ route('users.change', $data->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" value="{{ $data->username }}" readonly>
                    @error('username')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Kata Sandi Baru</label>
                    <input name="password_new" type="password" class="form-control" placeholder="...">
                    @error('password_new')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Ulangi Kata Sandi Baru</label>
                    <input name="password_confirm" type="password" class="form-control" placeholder="...">
                    @error('password_confirm')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <a href="{{ route('users.index') }}" class="btn btnn btn-outline-secondary">
                    <i class="fas fa-arrow-left custome-icon-color"> </i> Kembali
                </a>

                <button type="submit" name="submit" class="btn btn btn-outline-success">
                    <span class="fas fa-sync-alt custom-icon-color-green"></span> Perbarui
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
@section('active-menu-users', 'menu-open')
@section('active-users', 'active')