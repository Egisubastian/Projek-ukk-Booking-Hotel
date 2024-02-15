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
                    <li class="breadcrumb-item active">Edit Transaksi</li>
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
            <h3 class="card-title">Edit Data Transaksi</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('transactions.update', $transactions->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="nomor_unik">Nomor Unik</label>
                    <input name="nomor_unik" type="number" class="form-control" placeholder="..."
                        value="{{ $transactions->nomor_unik }}" readonly>
                    @error('nomor_unik')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input name="nama_pelanggan" type="text" class="form-control" placeholder="..."
                        value="{{ $transactions->nama_pelanggan }}" readonly>
                    @error('nama_pelanggan')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_produk">Nama Kamar + Harga</label>
                    <select id="id_produk" name="id_produk" class="form-control" required>
                        @if ($transactions->product)
                        <option value="{{ $transactions->product->id }}"
                            data-fasilitas="{{ $transactions->product->fasilitas }}"
                            data-harga="{{ $transactions->product->harga_produk }}" selected>
                            {{ $transactions->product->nama_produk }} - {{ $transactions->product->harga_produk }}
                        </option>
                        @endif

                        @foreach ($productsM as $data)
                        <option value="{{ $data->id }}" data-fasilitas="{{ $data->fasilitas }}"
                            data-harga="{{ $data->harga_produk }}" {{ $data->id == $transactions->id_produk ? 'selected'
                            : '' }}>
                            {{ $data->nama_produk }} - {{ $data->harga_produk }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_produk')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fasilitas">Fasilitas</label>
                    <input id="fasilitas" name="fasilitas" type="text" class="form-control" placeholder="..."
                        value="{{ $transactions->fasilitas }}" readonly>
                    @error('fasilitas')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_checkin">Tanggal Masuk</label>
                    <?php
                        // Convert the string to a Carbon instance
                        $tanggalCheckin = \Carbon\Carbon::parse($transactions->tanggal_checkin);
                    ?>
                    <input name="tanggal_checkin" id="tanggal_checkin" type="date" class="form-control"
                        placeholder="Pilih tanggal masuk..." value="{{ $tanggalCheckin->format('Y-m-d') }}" required>
                </div>

                <!-- Tambahkan input tanggal keluar -->
                <!-- Tambahkan input tanggal keluar -->
<div class="form-group">
    <label for="tanggal_checkout">Tanggal Keluar</label>
    <?php
        // Convert the string to a Carbon instance
        $tanggalCheckout = \Carbon\Carbon::parse($transactions->tanggal_checkout);
    ?>
    <input name="tanggal_checkout" id="tanggal_checkout" type="date" class="form-control"
        placeholder="Pilih tanggal keluar..." value="{{ $tanggalCheckout->format('Y-m-d') }}" required>
</div>


                <div class="form-group">
                    <label for="jumlah_hari">Jumlah Hari</label>
                    <input name="jumlah_hari" id="jumlah_hari" type="text" class="form-control"
                        placeholder="Jumlah hari" readonly value="{{ $transactions->jumlah_hari }}">
                </div>

                <div class="form-group">
                    <label for="total_harga">Total Biaya</label>
                    <input name="total_harga" id="total_harga" type="text" class="form-control" placeholder="..."
                        readonly value="{{ $transactions->total_harga }}">
                    @error('total_harga')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="uang_bayar">Uang Bayar</label>
                    <input name="uang_bayar" type="text" class="form-control" placeholder="..."
                        value="{{ $transactions->uang_bayar }}">
                    @error('uang_bayar')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Uang Kembali</label>
                    <input name="uang_kembali" type="text" class="form-control" placeholder="..."
                        value="{{ $transactions->uang_kembali }}" readonly>
                    @error('uang_kembali')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <a href="{{ route('transactions.index') }}" class="btn btnn btn-outline-secondary">
                    <i class="fas fa-arrow-left custome-icon-color"></i> Kembali
                </a>

                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin Mengubaha transaksi Ini?')" name="submit" class="btn btn btn-outline-success">
                    <span class="fas fa-sync-alt custom-icon-color-green"
                    onclick="return confirm('Apakah Anda yakin ingin mengedit data ini?')"></span> Perbarui
                </button>
            </form>
        </div>
        <!-- /.card-body -->
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

        tanggalMasukInput.addEventListener('change', function () {
            updateJumlahHari();
            updateTotalHarga();
            updateUangKembali();
        });

        tanggalKeluarInput.addEventListener('change', function () {
            updateJumlahHari();
            updateTotalHarga();
            updateUangKembali();
        });

        uangBayarInput.addEventListener('input', function () {
            updateUangKembali();
        });

        // Set initial values for tanggal masuk and tanggal keluar
        tanggalMasukInput.value = '{{ $tanggalCheckin->format('Y-m-d') }}';
        tanggalKeluarInput.value = '{{ $tanggalCheckout->format('Y-m-d') }}';

        // Call updateJumlahHari and updateTotalHarga initially
        updateJumlahHari();
        updateTotalHarga();

        // Format tanggal pada input tanggal keluar
        formatTanggal(document.getElementById('tanggal_checkout'));

        function formatTanggal(inputElement) {
            var value = inputElement.value;
            if (value !== '') {
                var date = new Date(value);
                var formattedDate = date.toISOString().split('T')[0];
                inputElement.value = formattedDate;
            }
        }

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

            // Check if a product is selected
            if (selectedOption) {
                var hargaProduk = parseFloat(selectedOption.getAttribute('data-harga'));
                var jumlahHari = parseInt(jumlahHariInput.value);

                if (!isNaN(hargaProduk) && !isNaN(jumlahHari) && jumlahHari > 0) {
                    var totalHarga = hargaProduk * jumlahHari;
                    totalHargaInput.value = totalHarga.toFixed(0);
                } else {
                    totalHargaInput.value = 0;
                }
            } else {
                // Set the price to 0 if no product is selected
                totalHargaInput.value = 0;
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

@endsection

@section('active-menu-transactions', 'menu-open')
@section('active-transactions', 'active')