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
                    <li class="breadcrumb-item active" style="color: #555;">Pengguna</li>
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
            <h3 class="card-title">Daftar Pengguna</h3>
        </div>

        <div class="card-body">
        @if ($message = Session::get('success'))
            <div id="successAlert" class="alert alert-success auto-hide-message">{{ $message }}</div>
            <script>
                setTimeout(function() {
                    var successAlert = document.getElementById('successAlert');
                    if (successAlert) {
                        successAlert.classList.add('fade-out'); 
                        setTimeout(function() {
                            successAlert.style.display = 'none'; 
                        }, 1000); 
                    }
                }, 1000);
            </script>
        @endif

            <a href="{{ route('users.create') }}" class="btn btn btn-outline-success" title="Tambah Kamar">
                <i class="fas fa-plus custom-icon-color-green"></i> Tambah Data
            </a>

            <a href="{{ url('users/pdf') }}" class="btn btnn btn-outline-info" title="Unduh Laporan PDF">
                <i class="fas fa-file-pdf custom-icon-color-blue "></i> Unduh PDF
            </a>

            <br>
            <br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-primary " id="myTable">
                    <thead class="thead-light" style="background-color: #3498db; color: #fff;">
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">ID</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Lengkap</th>
                            <th style="text-align: center; vertical-align: middle;">Username</th>
                            <th style="text-align: center; vertical-align: middle;">Role</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($UsersM) > 0)
                        @foreach ($UsersM as $index => $users)
                        <tr style="background-color: {{ $index % 1 == 0 ? '#edf4ff' : '#ffffff' }}">
                            <td style="text-align: center; vertical-align: middle;">{{ $users->id}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $users->name}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $users->username}}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $users->role}}</td>
                            <td style="text-align: center; vertical-align: middle;">


                                <a href="{{ route('users.edit', $users->id) }}" class="btn btn btn-outline-warning"title="Edit">
                                    <i class="fas fa-edit custom-icon-color-yellow"></i>
                                </a>

                                <a href="{{ route('users.changepassword', $users->id)}}"
                                    class="btn btn btn-outline-success" title="Ganti sandi">
                                    <i class="fas fa-key custom-icon-color-green"></i>
                                </a>

                                <form action="{{ route('users.destroy', $users->id) }}" method="POST"
                                    style="display: inline-block; margin-right: 5px;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn btn-outline-danger" title="Hapus"
                                        onclick="return confirm('Konfirmasi Hapus Data !?')">
                                        <i class="fas fa-trash-alt custome-icon-color"></i>
                                    </button>
                                </form>

                            </td>
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
        </div>
        <script type="text/javascript">
            let table = new DataTable('#myTable');
        </script>
    </div>
    <!-- /.card -->
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

@section('active-menu-users', 'menu-open')
@section('active-users', 'active')