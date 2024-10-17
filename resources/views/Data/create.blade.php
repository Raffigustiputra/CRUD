@extends('layout.layout')

@section('content')
    <form action="{{ route( 'siswa.tambah.formulir') }}" method="POST" class="card p-5">

        {{--
            1.tag <form> attr action & method
                method:
                - GET : form tujuan mencari data (search)
                - GET : form tujuan menambahkan/menghapus/mengubah
                action : route memproses data
                - arahkan route yang akan menangani proses data yang ke db nya
                - jika GET : arahkan ke route yang sama dengan route yang menampilkan blade ini
        --}}

        @csrf
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Siswa :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Siswa" value="{{ old('nama') }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">Nis :</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="nis" name="nis" placeholder="Masukkan Nis" value="{{ old('nis') }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="rayon" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" placeholder="Apa Rayon Anda" value="{{ old('rayon') }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel" placeholder="Apa Rombel Anda" value="{{ old('rombel') }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="eskul" class="col-sm-2 col-form-label">Ekstrakurikuler :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="eskul" name="eskul" placeholder="Apa Eskul Anda" value="{{ old('eskul') }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Data</button>
    </form>
@endsection
