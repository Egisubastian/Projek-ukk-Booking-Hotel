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
                    <li class="breadcrumb-item active" style="color: #555;">Log Aktivitas</li>
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
            <h3 class="card-title">Hotel Suka Suka</h3>
        </div>

        <div class="card-body">
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-primary" id="myTable">
                    <thead class="thead-light" style="background-color: #f8f9fa;">
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">ID</th>
                            <th style="text-align: center; vertical-align: middle;">Nama User</th>
                            <th style="text-align: center; vertical-align: middle;">Activity</th>
                            <th style="text-align: center; vertical-align: middle;">Tanggal & Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($logM) > 0)
                        @foreach ($logM as $index => $log)
                        <tr style="background-color: {{ $index % 2 == 0 ? '#edf4ff' : '#ffffff' }}">
                            <td style="text-align: center; vertical-align: middle;">{{ $log->id }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $log->name }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $log->activity }}</td>
                            <td style="text-align: center; vertical-align: middle;">{{ $log->created_at }}</td>
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
    </div>
    <!-- /.card -->
</section>
<script type="text/javascript">
    let table = new DataTable('#myTable');
</script>
@endsection

@section('active-menu-log', 'menu-open')
@section('active-log', 'active')