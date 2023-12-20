@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pet shop Lontar</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Activity</h3>
        </div>

        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            <br>
            <table class="table table-striped table-bordered">
                <tr>
                    <th style="text-align: center; vertical-align: middle;">ID</th>                   
                    <th style="text-align: center; vertical-align: middle;">Nama User</th>
                    <th style="text-align: center; vertical-align: middle;">Activity</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal & Waktu</th>
                </tr>
                @if(count($logM) > 0)
                @foreach ($logM as $log)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $log->id }}</td>                 
                    <td style="text-align: center; vertical-align: middle;">{{ $log->name }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $log->activity }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $log->created_at }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3">Data Tidak Ditemukan</td>
                </tr>
                @endif
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection