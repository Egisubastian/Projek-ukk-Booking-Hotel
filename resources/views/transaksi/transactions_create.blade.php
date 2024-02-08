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
                    <li class="breadcrumb-item active">Tambah Transaksi</li>
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
            <h3 class="card-title">Tambah Data Transaksi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="">Nomor Unik</label>
                    <input name="nomor_unik" type="number" class="form-control" placeholder="..."
                        value="{{ random_int(1000000000, 9999999999) }}" readonly>
                    @error('nomor_unik')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Nama Pelanggan</label>
                    <input name="nama_pelanggan" type="text" class="form-control" placeholder="...">
                    @error('tanggal_checkin')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Nama Kamar + Harga</label>
                    <select name="id_produk" id="id_produk" class="form-control" required>
                        <option value=""></option>
                        @foreach ($productsM as $data)
                        <option value="{{ $data->id }}" data-fasilitas="{{ $data->fasilitas }}"
                            data-harga="{{ $data->harga_produk }}">
                            {{ $data->nama_produk }} - {{$data->harga_produk}}
                        </option>
                        @endforeach
                    </select>
                    @error('id_produk')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Fasilitas</label>
                    <input name="fasilitas" id="fasilitas" type="text" class="form-control" placeholder="..." readonly>
                    @error('fasilitas')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_checkin">Tanggal Masuk</label>
                    <input name="tanggal_checkin" id="tanggal_checkin" type="date" class="form-control"
                        placeholder="Pilih tanggal masuk..." required>
                </div>

                <!-- Tambahkan input tanggal keluar -->
                <div class="form-group">
                    <label for="tanggal_checkout">Tanggal Keluar</label>
                    <input name="tanggal_checkout" id="tanggal_checkout" type="date" class="form-control"
                        placeholder="Pilih tanggal keluar..." required>
                </div>

                <!-- Ganti input jumlah hari dengan readonly -->
                <div class="form-group">
                    <label for="jumlah_hari">Jumlah Hari</label>
                    <input name="jumlah_hari" id="jumlah_hari" type="text" class="form-control"
                        placeholder="Jumlah hari" readonly>
                </div>


                <div class="form-group">
                    <label for="">Total Harga</label>
                    <input name="total_harga" id="total_harga" type="text" class="form-control" placeholder="..."
                        readonly>
                    @error('total_harga')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Uang Bayar</label>
                    <input name="uang_bayar" type="text" class="form-control" placeholder="...">
                    @error('uang_bayar')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Uang Kembali</label>
                    <input name="uang_kembali" type="text" class="form-control" placeholder="...">
                    @error('uang_kembali')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <a href="{{ route('transactions.index') }}" class="btn btn btn-outline-secondary">
                    <i class="fas fa-arrow-left custome-icon-color"> </i> Kembali
                </a>

                <button type="submit" name="submit" class="btn btn btn-outline-success">
                    <i class="fas fa-plus custom-icon-color-green"></i> Tambah
                </button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

<style>
    .btn {
        border: 2px solid #16253d;
        /* Warna hijau cerah dan ketebalan stroke */
        transition: border-color 0.3s ease;
        /* Efek transisi untuk perubahan warna */
        border-radius: 4px;
        /* Pemberian sudut pada border (opsional) */
    }

    .btn:hover {
        outline: none;
        border-color: #3366ff;
    }

    .perbarui {
        border: 2px solid #53cc17;
        /* Warna hijau cerah dan ketebalan stroke */
        transition: border-color 0.3s ease;
        /* Efek transisi untuk perubahan warna */
        border-radius: 4px;
        /* Pemberian sudut pada border (opsional) */
    }

    .perbarui:hover {
        outline: none;
        border-color: #3366ff;
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var produkSelect = document.getElementById('id_produk');
        var fasilitasInput = document.getElementById('fasilitas');
        var tanggalMasukInput = document.getElementById('tanggal_checkin');
        var tanggalKeluarInput = document.getElementById('tanggal_checkout');
        var jumlahHariInput = document.getElementById('jumlah_hari');
        var totalHargaInput = document.getElementById('total_harga');
        var uangBayarInput = document.querySelector('input[name="uang_bayar"]');
        var uangKembaliInput = document.querySelector('input[name="uang_kembali"]');

        produkSelect.addEventListener('change', function () {
            var selectedOption = produkSelect.options[produkSelect.selectedIndex];
            fasilitasInput.value = selectedOption.getAttribute('data-fasilitas');
            updateTotalHarga();
            updateUangKembali();
        });

        tanggalMasukInput.addEventListener('input', function () {
            updateJumlahHari();
            updateTotalHarga();
            updateUangKembali();
        });

        tanggalKeluarInput.addEventListener('input', function () {
            updateJumlahHari();
            updateTotalHarga();
            updateUangKembali();
        });

        uangBayarInput.addEventListener('input', function () {
            updateUangKembali();
        });

        function updateJumlahHari() {
            var tanggalMasuk = new Date(tanggalMasukInput.value);
            var tanggalKeluar = new Date(tanggalKeluarInput.value);

            if (!isNaN(tanggalMasuk.getTime()) && !isNaN(tanggalKeluar.getTime())) {
                var selisihHari = Math.floor((tanggalKeluar - tanggalMasuk) / (24 * 60 * 60 * 1000));
                selisihHari = Math.max(selisihHari, 0);

                jumlahHariInput.value = selisihHari;
            }
        }

        function updateTotalHarga() {
            var selectedOption = produkSelect.options[produkSelect.selectedIndex];
            var hargaProduk = parseFloat(selectedOption.getAttribute('data-harga'));
            var jumlahHari = parseInt(jumlahHariInput.value);

            if (!isNaN(hargaProduk) && !isNaN(jumlahHari) && jumlahHari > 0) {
                var totalHarga = hargaProduk * jumlahHari;

                // Format totalHarga to remove decimal places
                totalHargaInput.value = totalHarga.toFixed(0);
            }
        }

        function updateUangKembali() {
            var uangBayar = parseFloat(uangBayarInput.value);
            var totalHarga = parseFloat(totalHargaInput.value);

            if (!isNaN(uangBayar) && !isNaN(totalHarga) && uangBayar >= totalHarga) {
                var uangKembali = uangBayar - totalHarga;

                // Format uangKembali to remove decimal places
                uangKembaliInput.value = uangKembali.toFixed(0);
            } else {
                // If uangBayar is less than totalHarga or not a number, set uangKembali to the negative difference
                var uangKembali = uangBayar - totalHarga;
                uangKembaliInput.value = uangKembali.toFixed(0);
            }
        }

    });

</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection

@section('active-menu-transactions', 'menu-open')
@section('active-transactions', 'active')