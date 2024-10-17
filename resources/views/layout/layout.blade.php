<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD DATA SISWA</title>
    <link rel="icon" href="{{ asset('assets/images/wikrama.jpg') }}">
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container">
            <!-- Navbar Brand -->
            <a class="navbar-brand" href="#">Data Siswa</a>

            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto"> <!-- Added ms-auto for right alignment -->
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('landing_page') ? 'text-primary' : '' }}" aria-current="page"
                            href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle
                        {{ Route::is('siswa.data') || Route::is('siswa.tambah.formulir') ? 'text-primary' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tabel Siswa
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item {{ Route::is('siswa.data') ? 'text-primary' : '' }}"
                                    href="{{ route('siswa.data') }}">Data Siswa</a></li>
                            <li><a class="dropdown-item {{ Route::is('siswa.tambah.form') ? 'text-primary' : '' }}"
                                    href="{{ route('siswa.tambah') }}">Tambah Data</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle
                        {{ Route::is('user.data') || Route::is('user.tambah.formulir') ? 'text-primary' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kelola Akun
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" {{ Route::is('user.data') ? 'text-primary' : '' }}
                                    href="{{ route('user.data') }}">Kelola Akun</a></li>
                            <li><a class="dropdown-item" {{ Route::is('user.tambah_formulir') ? 'text-primary' : '' }}
                                    href="{{ route('user.tambah') }}">Tambah</a></li>
                            {{-- <li><a class="dropdown-item" href="">Stock</a></li> --}}
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('script')
</body>

</html>
