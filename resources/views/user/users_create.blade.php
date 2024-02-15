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
    </div>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card elevation-2">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Pengguna</h3>
        </div>
        <div class="card-body">

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="name" type="text" class="form-control" placeholder="...">
                    @error('name')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" placeholder="...">
                    @error('username')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" placeholder="...">
                    @error('password')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Ulangi Password</label>
                    <input name="password_confirm" type="password" class="form-control" placeholder="...">
                    @error('password_confirm')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option>Pilih Role</option>
                        <option value="kasir">Kasir</option>
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                    </select>
                    @error('role')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <a href="{{ route('users.index') }}" class="btn btnn btn-outline-secondary">
                    <i class="fas fa-arrow-left custome-icon-color"> </i> Kembali
                </a>

                <button type="submit"  onclick="return confirm('Apakah Anda yakin ingin menambahkan data pengguna baru?')" name="submit" class="btn btn btn-outline-success">
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
@section('active-menu-users', 'menu-open')
@section('active-users', 'active')