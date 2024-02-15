@extends('adminlte')
@section('content')
<section class="content-header" style="background-color: #f2f2f2; padding: 20px;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 style="color: #333; font-size: 24px;">Booking Hotel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right" style="background-color: transparent; margin-top: 5px;">
                    <li class="breadcrumb-item active" style="color: #555;">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Dashboard</h3>
        </div>
        <!-- Info boxes -->
        <?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ukk_booking_hotel';
$conn = new mysqli($host, $username, $password, $database);
// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$queryProducts = "SELECT COUNT(*) as total_products FROM products";
$resultProducts = $conn->query($queryProducts);

$queryTransactions = "SELECT COUNT(*) as total_transactions FROM transactions";
$resultTransactions = $conn->query($queryTransactions);

$queryUsers = "SELECT COUNT(*) as total_users FROM users";
$resultUsers = $conn->query($queryUsers);

$queryTotalHarga = "SELECT SUM(total_harga) as total_total_harga FROM transactions";
$resultTotalHarga = $conn->query($queryTotalHarga);


if ($resultProducts && $resultTransactions && $resultUsers) {
    $rowProducts = $resultProducts->fetch_assoc();
    $totalProducts = $rowProducts['total_products'];

    $rowTransactions = $resultTransactions->fetch_assoc();
    $totalTransactions = $rowTransactions['total_transactions'];

    $rowUsers = $resultUsers->fetch_assoc();
    $totalUsers = $rowUsers['total_users'];
} else {
    $totalProducts = 0;
    $totalTransactions = 0;
    $totalUsers = 0;
}

if ($resultTotalHarga) {
    $rowTotalHarga = $resultTotalHarga->fetch_assoc();
    $totalTotalHarga = $rowTotalHarga['total_total_harga'];
} else {
    $totalTotalHarga = 0;
}

$queryAvailableProducts = "SELECT COUNT(*) as total_available_products FROM products WHERE status = 'available'";
$resultAvailableProducts = $conn->query($queryAvailableProducts);
$rowAvailableProducts = $resultAvailableProducts->fetch_assoc();
$totalAvailableProducts = $rowAvailableProducts['total_available_products'];

$queryBookedProducts = "SELECT COUNT(*) as total_booked_products FROM products WHERE status = 'booked'";
$resultBookedProducts = $conn->query($queryBookedProducts);
$rowBookedProducts = $resultBookedProducts->fetch_assoc();
$totalBookedProducts = $rowBookedProducts['total_booked_products'];

// Tutup koneksi database
$conn->close();
?>
        <br>
        <div class="container">
            <div class="row">
                <!-- Kamar -->
                @if (in_array(Auth::user()->role, ['admin','owner']))
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="{{ url('/products') }}" class="text-decoration-none text-dark">
                        <div class="info-box bg-info">
                            <span class="info-box-icon elevation-1 bg-user">
                                <i class="fas fa-bed text-info"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kamar</span>
                                <span class="info-box-number">
                                    {{ $totalProducts }}
                                    <small>Kamar</small>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @if (in_array(Auth::user()->role, ['kasir']))
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="{{ url('/products') }}" class="text-decoration-none text-dark">
                        <div class="info-box bg-info">
                            <span class="info-box-icon elevation-1 bg-user">
                                <i class="fas fa-bed text-info"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kamar</span>
                                <span class="info-box-number">
                                {{ $totalProducts }} -  <small>Tersedia</small>  {{ $totalAvailableProducts }}
                                    <small>Kamar</small>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Transaksi -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="{{ url('/transactions') }}" class="text-decoration-none text-dark">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon elevation-1 bg-user">
                                <i class="fas fa-exchange-alt text-danger"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Transaksi</span>
                                <span class="info-box-number">
                                    {{ $totalTransactions }}
                                    <small>Transaksi</small>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Uang Kembali -->
                <!-- Uang Kembali -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="info-box bg-secondary">
                        <span class="info-box-icon elevation-1 bg-user">
                            <i class="fas fa-chart-line text-secondary"></i>
                        </span>
                        <div class="info-box-content" style="height: 60px;">
                            <span class="info-box-text">Pedapatan</span>
                            <span class="info-box-number" id="refundValue">
                                {{ number_format($totalTotalHarga, 0, ',', '.') }}
                                <small>Rupiah</small>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Members -->
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <a href="{{ url('/users') }}" class="text-decoration-none text-dark">
                        <div class="info-box bg-success-custom">
                            <span class="info-box-icon info elevation-1 bg-user"><i
                                    class="fas fa-users text-success"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text text-light">Pengguna</span>
                                <span class="info-box-number text-light">
                                    {{ $totalUsers }}
                                    <small class="text-light">User</small>
                                </span>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let infoBoxes = document.querySelectorAll('.info-box');

                infoBoxes.forEach(function (box) {
                    box.addEventListener('mouseenter', function () {
                        this.style.transform = 'scale(1.05)';
                    });

                    box.addEventListener('mouseleave', function () {
                        this.style.transform = 'scale(1)';
                    });
                });
            });
        </script>

        </head>

        <body>
            <header
                style="background: linear-gradient(to right, rgb(0, 0, 128), rgb(45, 45, 45), rgb(128, 0, 32)); color: #fff; text-align: center; padding: 20px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; position: relative;">
                <h1 style="margin: 0; font-size: 36px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Selamat Datang - {{
                    Auth::user()->name }}
                </h1>
            </header>
            <br>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <a href="{{ url('/transactions') }}" class="text-decoration-none text-dark">
                        <div id="imageCarousel1" class="carousel slide" data-ride="carousel"
                            style="height: 400px; overflow: hidden;">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="dist/img/g3.jpg" alt="Hotel 1" class="d-block w-100"
                                        style="height: 100%;">
                                    <div class="carousel-caption">
                                        <h5>Hotel</h5>
                                        <p>.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="dist/img/renang.jpg" alt="Hotel 2" class="d-block w-100"
                                        style="height: 100%;">
                                    <div class="carousel-caption">
                                        <h5>Kolam Renang</h5>
                                        <p>.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="dist/img/kamar.jpg" alt="Hotel 3" class="d-block w-100"
                                        style="height: 100%;">
                                    <div class="carousel-caption">
                                        <h5>Kamar Hotel</h5>
                                        <p>.</p>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#imageCarousel1" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#imageCarousel1" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-4">
                    <a href="{{ url('/transactions') }}" class="text-decoration-none text-dark">
                        <div id="imageCarousel2" class="carousel slide" data-ride="carousel"
                            style="height: 400px; overflow: hidden;">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="dist/img/g9.jpg" alt="Your New Image" class="d-block w-100"
                                        style="height: 100%;">
                                    <div class="carousel-caption">
                                        <h5></h5>
                                        <p>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <script>
                // Show carousel controls on hover
                $(".carousel").hover(function () {
                    $(this).find(".carousel-control-prev, .carousel-control-next").fadeIn();
                }, function () {
                    $(this).find(".carousel-control-prev, .carousel-control-next").fadeOut();
                });
            </script>

        </body>
    </div>
</div>
</div>
</div>
</div>
</div>
<style>
    body {
        margin: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f2f2f2;
        /* Set a light background color */
    }

    header {
        color: #fff;
        text-align: center;
        padding: 20px;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        position: relative;
    }

    header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.2;
        z-index: -1;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .gallery-container {
        display: flex;
        justify-content: space-around;
        padding: 20px;
        flex-wrap: wrap;
    }

    .gallery-item a {
        border: 2px solid #;
        /* Adjusted border color */
        display: inline-block;
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    .gallery-item img {
        width: 100%;
        height: auto;
        display: block;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .gallery-caption {
        text-align: center;
        padding: 10px;
        color: #fff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }

    .bg-success-custom {
        background-color: #21c500;
    }

    .bg-user {
        background-color: #fff;
    }
</style>
@endsection
@section('active-menu-dashboard', 'menu-open')
@section('active-dashboard', 'active')