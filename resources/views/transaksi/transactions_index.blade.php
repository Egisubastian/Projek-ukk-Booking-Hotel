@extends('adminlte')
@section('content')
<section class="content-header" style="background-color: #f2f2f2; padding: 20px;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="color: #333; font-size: 24px;">Booking Hotel</h1>
                <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color: transparent; margin-top: 5px;">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" style="color: #555;">Transaksi</li>
                </ol>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div>
        </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Transaksi Kamar</h3>
        </div>

        <div class="card-body">
            @if ($message = Session::get('success'))
                <div id="successAlert" class="alert alert-success auto-hide-message">{{ $message }}</div>
            @endif

            @if ($error = Session::get('error'))
                <div id="errorAlert" class="alert alert-danger">{{ $error }}</div>
            @endif
            @if (in_array(Auth::user()->role, ['owner'])) 
            <form action="{{ route('transactions.pdfFilter') }}" method="GET" class="form-inline my-2">
                <input type="date" class="form-control mr-2 btn-outline-primary" name="start_date" data-toggle="tooltip"
                    title="Tanggal Masuk" />

                <span class="input-group-text sampai-text stroke-text mr-2" data-toggle="tooltip"
                    title="Sampai">-</span>

                <input type="date" class="form-control mr-2 btn-outline-primary" name="end_date" data-toggle="tooltip"
                    title="Tanggal Keluar" />

                <button type="submit" class="btn btn btn-sm ml-1 btn btnn btn-pdf btn-outline-info"
                    data-toggle="tooltip" title="Unduh Laporan PDF">
                    <i class="fas fa-file-pdf text-primary"></i> Laporan PDF
                </button>
                
                <script>
                    $(function () {
                        $('[data-toggle="tooltip"]').tooltip();
                    });
                </script>
            </form>
            @endif

            @if (in_array(Auth::user()->role, ['kasir']))
                <a href="{{ route('transactions.create') }}" class="btn btn btn-outline-success" title="Tambah Transaksi">
                    <i class="fas fa-plus custom-icon-color-green"></i> Tambah Transaksi
                </a>
<br>
<br>
            @endif
            @if (in_array(Auth::user()->role, ['admin','kasir']))
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-primary" id="myTable">
                        <thead class="thead-light" style="background-color: #3498db; color: #fff;">
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">ID</th>
                                <th style="text-align: center; vertical-align: middle;">Nomor Unik</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Pelanggan</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Kamar</th>
                                <th style="text-align: center; vertical-align: middle;">Harga Kamar</th>
                                <th style="text-align: center; vertical-align: middle;">Pesan</th>
                                <th style="text-align: center; vertical-align: middle;">Total Harga</th>
                                <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
                                <th style="text-align: center; vertical-align: middle;">Uang Kembali</th>
                                <th style="text-align: center; vertical-align: middle;">Tanggal Masuk</th>
                                <th style="text-align: center; vertical-align: middle;">Tanggal Keluar</th>
                                <th style="text-align: center; vertical-align: middle;">Status</th>
                                @if (in_array(Auth::user()->role, ['admin','kasir']))
                                    <th style="text-align: center; vertical-align: middle;">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactionsM as $transaction)
                                <tr style="background-color: {{ $loop->index % 2 == 2 ? '#ffffff' : '#edf4ff' }}">
                                    <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nomor_unik }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nama_pelanggan }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nama_produk }}</td>
                                    <td style="text-align: center; vertical-align: middle;">Rp {{ number_format($transaction->harga_produk, 0, ',', '.') }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->jumlah_hari }} Hari</td>
                                        @if(isset($transaction->total_harga))
                                            <td style="text-align: center; vertical-align: middle;">Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                                        @else
                                            <td style="text-align: center; vertical-align: middle;">-</td>
                                        @endif
                                    <td style="text-align: center; vertical-align: middle;">Rp{{ number_format($transaction->uang_bayar, 0, ',', '.') }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;"> Rp{{ number_format($transaction->uang_kembali, 0, ',', '.') }}
                                    </td>

                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->tanggal_checkin }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->tanggal_checkout }}</td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        @if($transaction->checkout_status == '1')
                                            <span class="badge badge-success">Keluar</span>
                                        @else
                                            <span class="badge badge-danger">Masuk</span>
                                        @endif
                                    </td>

                                    <td style="text-align: center; vertical-align: middle;">
                                        @if (in_array(Auth::user()->role, ['kasir']))
                                            <div class="btn-group" role="group" aria-label="Aksi">
                                                <a href="{{ url('transactions/cetak', $transaction->id_trans) }}"
                                                    class="btn btn- mr-1 btn-outline-primary" title="Cetak">
                                                    <i class="fas fa-print custom-icon-color-blue"></i>
                                                </a>
                                                <button type="button" class="btn btn btn-outline-info" data-toggle="modal"
                                                    data-target="#infoModal{{ $transaction->id_trans }}" title="Info">
                                                    <i class="fas fa-info-circle custom-icon-color-info"></i>
                                                </button>
                                            </div>
                                        @endif
                                        @if (in_array(Auth::user()->role, ['admin']))
                                            <div class="btn-group" role="group" aria-label="Aksi">
                                                <a href="{{ route('transactions.edit', $transaction->id_trans) }}"
                                                    class="btn btn-outline-warning mr-1" title="Edit">
                                                    <i class="fas fa-edit custom-icon-color-yellow"></i>
                                                </a>
                                                <form action="{{ route('transactions.destroy', $transaction->id_trans) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger" title="Hapus"
                                                        onclick="return confirm('Konfirmasi Hapus Transaksi !?')">
                                                        <i class="fas fa-trash-alt custom-icon-color "></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="12">Transaksi Tidak Ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
<br>
            @if (in_array(Auth::user()->role, ['owner']))
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-primary" id="myTable">
                        <thead class="thead-light" style="background-color: #3498db; color: #fff;">
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">ID</th>
                                <th style="text-align: center; vertical-align: middle;">Nomor Unik</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Pelanggan</th>
                                <th style="text-align: center; vertical-align: middle;">Nama Kamar</th>
                                <th style="text-align: center; vertical-align: middle;">Harga Kamar</th>
                                <th style="text-align: center; vertical-align: middle;">Pesan</th>
                                <th style="text-align: center; vertical-align: middle;">Total Harga</th>
                                <th style="text-align: center; vertical-align: middle;">Uang Bayar</th>
                                <th style="text-align: center; vertical-align: middle;">Uang Kembali</th>
                                <th style="text-align: center; vertical-align: middle;">Tanggal Masuk</th>
                                <th style="text-align: center; vertical-align: middle;">Tanggal Keluar</th>
                                <th style="text-align: center; vertical-align: middle;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactionsM as $transaction)
                                <tr style="background-color: {{ $loop->index % 2 == 2 ? '#ffffff' : '#edf4ff' }}">
                                    <td style="text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nomor_unik }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nama_pelanggan }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->nama_produk }}</td>
                                    <td style="text-align: center; vertical-align: middle;">Rp{{ number_format($transaction->harga_produk, 0, ',', '.') }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">Rp{{ $transaction->jumlah_hari }} Hari</td>
                                    @if(isset($transaction->total_harga))
                                    <td style="text-align: center; vertical-align: middle;">Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                                    @else
                                        <td style="text-align: center; vertical-align: middle;">-</td>
                                    @endif
                                    <td style="text-align: center; vertical-align: middle;">Rp{{ number_format($transaction->uang_bayar, 0, ',', '.') }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">Rp {{ number_format($transaction->uang_kembali, 0, ',', '.') }}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->tanggal_checkin }}</td>
                                    <td style="text-align: center; vertical-align: middle;">{{ $transaction->tanggal_checkout }}</td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        @if($transaction->checkout_status == '1')
                                            <span class="badge badge-success">Keluar</span>
                                        @else
                                            <span class="badge badge-danger">Masuk</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12">Transaksi Tidak Ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

            <script type="text/javascript">
                $(document).ready(function () {
                    let table = new DataTable('#myTable');
                    $(".btn-checkout").click(function () {
                        var hargaKamar = parseFloat($(this).closest('.modal-content').find(".modal-body").data("harga"));
                        var uangBayar = parseFloat($(this).closest('.modal-content').find("input[name='uang_bayar']").val());
                        if (uangBayar < hargaKamar) {
                            alert("Uang yang dibayar tidak cukup. Pastikan jumlah pembayaran sesuai dengan harga kamar.");
                            return false; 
                        }
                        return true;
                    });
                });

                    setTimeout(function() {
                        var errorAlert = document.getElementById('errorAlert');
                        if (errorAlert) {
                            errorAlert.classList.add('fade-out');
                            setTimeout(function() {
                                errorAlert.style.display = 'none'; 
                            }, 1000); 
                        }
                    }, 1000); //
                                 
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
            @foreach ($transactionsM as $transaction)
            <div class="modal fade" id="infoModal{{ $transaction->id_trans }}" tabindex="-1" role="dialog"
                aria-labelledby="infoModalLabel{{ $transaction->id_trans }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="infoModalLabel{{ $transaction->id_trans }}">Informasi Transaksi
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nomor Unik:</strong> {{ $transaction->nomor_unik }}</p>
                            <p><strong>Nama Pelanggan:</strong> {{ $transaction->nama_pelanggan }}</p>
                            <p><strong>Nama Kamar:</strong> {{ $transaction->nama_produk }}</p>
                            <p><strong>Harga Kamar:</strong> {{ number_format($transaction->harga_produk, 0, ',', '.') }}</p>
                            <p><strong>Pesan :</strong> {{ $transaction->jumlah_hari }} Hari</p>
                            <p><strong>Uang Bayar:</strong> {{ number_format($transaction->uang_bayar, 0, ',', '.') }}</p>
                            <p><strong>Uang Kembali:</strong> {{ number_format($transaction->uang_kembali, 0, ',', '.') }}</p>
                            <p><strong>Tanggal Masuk:</strong> {{ $transaction->tanggal_checkin }}</p>
                            <p><strong>Tanggal Keluar:</strong> {{ $transaction->tanggal_checkout }}</p>
                            <p><strong>Status:</strong> {{ $transaction->checkout_status ? 'sudah Checkout' : 'Belum
                                Checkout' }}</p>                         
                             @if ($transaction->uang_kembali < 0) 
                             <div class="alert alert-danger mt-2">
                                Bayar kamar terlebih dahulu sebelum melakukan Check Out.
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        @if (!$transaction->checkout_status)
                        <!-- Tombol Check Out hanya muncul jika uang kembali lebih besar dari 0 -->
                        @if ($transaction->uang_kembali > -1)
                        <form action="{{ route('transactions.checkout', $transaction->id_trans) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-checkout"
                                onclick="return confirm('Konfirmasi Check Out Transaksi ?')">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        @endif
                        @else

                        @endif
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
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
    .custom-icon-color {
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

    .custom-icon-color-info {
        color: #00e0bd;
    }

    .btn-pdf {
        border-radius: 4px;
        transition: border-color 0.3s ease;
        padding: 8px 18px;
        font-size: 14px;
    }
</style>

@endsection
@section('active-menu-transactions', 'menu-open')
@section('active-transactions', 'active')