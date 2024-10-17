@extends('layout.layout')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
    @endif
    <div class="container">
        <div class="d-flex justify-content-end">
            <form class="d-flex" role="search" action="{{ route('siswa.data') }}" method="GET"">
                <input type="text" class="form-control me-2" placeholder="Search Data Siswa" aria-label="Search"
                    name="search_siswa">
                <button class="btn btn-outline-primary" type="submit">Search</button>
                <a href="{{ route('siswa.export') }}" class="btn btn-success ms-2">Export</a>
            </form>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Nis</th>
                    <th>Rayon</th>
                    <th>Rombel</th>
                    <th>Eskul</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data) < 1)
                    <tr>
                        <td colspan="6" class="text-center">Data obat kosong</td>
                    </tr>
                @else
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>{{ ($data->currentPage() - 1) * $data->perPage() + ($index + 1) }}
                            </td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['nis'] }}</td>
                            <td>{{ $item['rayon']}}</td>
                            <td>{{ $item['rombel'] }}</td>
                            <td>{{ $item['eskul'] }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                {{-- <button class="btn btn-primary me-2" >Edit</button> --}}
                                <a href="{{ route('siswa.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger"
                                    onclick="showModal ('{{ $item->id }}' , '{{ $item->name }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        {{-- modal hapus stock --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form-delete-datsis" method="POST">
                    @csrf
                    {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
                    method untul menghapus data- --}}
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Siswa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus data siswa ini?<span id="nama-siswa"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex justify-content-end">{{ $data->links() }}</div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function showModal(id, name) {
            // ini untuk url delete nya (Route)
            let urlDelete = "{{ route('siswa.hapus', ':id') }}";
            // ganti id di url dengan id yang dikirim
            urlDelete = urlDelete.replace(':id', id);

            //Ini untuk action attributnya
            $('#form-delete-datsis').attr('action', urlDelete);
            // ini untuk show modalnya
            $('#exampleModal').modal('show');
            // ini untuk mengisi modalnya
            $('#nama-siswa').text(name);
        }

        @if (Session::get('failed'))
            // jika halaman htmlnya sudah selesai load cdn, jalankan di dalamannya
            $(document).ready(function() {
                // id dari with failed 'id' controller redirect back
                let id = "{{ Session::get('id') }}";
                // id dari with failed 'stock' controller redirect back
                let stock = "{{ Session::get('stock') }}";
                // id dari function showModalStock dengan data id dan stock diatas
                showModalStock(id, stock);
            });
        @endif
    </script>
@endpush
