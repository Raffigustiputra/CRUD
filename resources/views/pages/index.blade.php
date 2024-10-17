@extends('layout.layout')

@section('content')

<style>
    .hero {
        background: linear-gradient(to right, #007bff, #f8f9fa); /* Warna latar belakang biru dan putih */
        color: white;
    }

    .hero-text h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .hero-text p {
        font-size: 1.25rem;
    }

    .hero-image img {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-siswa-data {
        background-color: #007bff;
        color: white;
        border-radius: 30px;
        padding: 15px 30px;
        text-decoration: none;
        font-size: 1.1rem;
        transition: background-color 0.3s ease;
    }

    .btn-siswa-data:hover {
        background-color: #0056b3;
    }

    .card-service {
        transition: transform 0.3s ease;
        border: none;
    }

    .card-service:hover {
        transform: translateY(-10px);
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        background-color: #007bff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 15px;
    }

    .icon-circle i {
        color: white;
        font-size: 1.5rem;
    }

    @media (max-width: 768px) {
        .hero {
            flex-direction: column;
            text-align: center;
        }

        .hero-text {
            margin-bottom: 20px;
        }

        .hero-image img {
            max-width: 100px;
        }

        .hero-text h1 {
            font-size: 2rem;
        }

        .hero-text p {
            font-size: 1rem;
        }
    }
</style>

<div class="container mt-5">
    <!-- Hero Section -->
    <div class="hero bg-light p-5 rounded shadow-sm d-flex align-items-center justify-content-between flex-wrap">
        <div class="hero-text">
            <h1 class="display-4">Selamat Datang di Web Data Siswa</h1>
            <p class="lead">Kami siap membantu Anda dalam pengelolaan data siswa dengan mudah dan efisien.</p>

            <!-- Button to navigate to siswa.data page -->
            <a href="{{ route('siswa.data') }}" class="btn-siswa-data mt-4">Lihat Data Siswa</a>
        </div>
        <div class="hero-image">
            <img src="{{ asset('assets/images/wikrama.jpg') }}" alt="Wikrama" class="img-fluid" style="max-width: 150px;">
        </div>
    </div>

    <!-- Services Section -->
    <div class="row mt-5 text-center">
        <div class="col-md-4 mb-4">
            <div class="card p-4 card-service shadow-sm">
                <div class="icon-circle mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <h5 class="card-title">Manajemen Siswa</h5>
                <p class="card-text">Kelola data siswa secara teratur dan aman dengan sistem kami yang intuitif.</p>
                <a href="#" class="btn btn-outline-primary">Pelajari lebih lanjut</a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card p-4 card-service shadow-sm">
                <div class="icon-circle mx-auto">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h5 class="card-title">Analisis Data</h5>
                <p class="card-text">Dapatkan laporan dan analisis data siswa untuk pengambilan keputusan yang lebih baik.</p>
                <a href="#" class="btn btn-outline-primary">Pelajari lebih lanjut</a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card p-4 card-service shadow-sm">
                <div class="icon-circle mx-auto">
                    <i class="fas fa-cogs"></i>
                </div>
                <h5 class="card-title">Pengaturan Sistem</h5>
                <p class="card-text">Sesuaikan fitur dan pengaturan sistem sesuai dengan kebutuhan sekolah Anda.</p>
                <a href="#" class="btn btn-outline-primary">Pelajari lebih lanjut</a>
            </div>
        </div>
    </div>
</div>

@endsection
