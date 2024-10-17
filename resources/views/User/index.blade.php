@extends('layout.layout')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }}</div>
    @endif
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <!-- Form Pencarian -->
            <form class="d-flex" role="search" action="{{ route('user.data')}}" method="GET">
                <input type="text" class="form-control me-2" placeholder="Search Data Akun" aria-label="Search" name="search_akun">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>

            <!-- Tombol Print PDF -->
            <button class="btn btn-outline-secondary ms-2" id="printBtn">Print PDF</button>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (count($user) < 1)
                    <tr>
                        <td colspan="6" class="text-center">Data akun kosong</td>
                    </tr>
                @else
                    @foreach ($user as $index => $item)
                        <tr>
                            <td>{{ ($user->currentPage() - 1) * $user->perPage() + ($index + 1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['role'] }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger" onclick="showModal ('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="d-flex justify-content-end">{{ $user->links() }}</div>
    </div>

    {{-- Modal hapus --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-delete-akun" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus data <span id="nama-akun"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function showModal(id, name) {
            let urlDelete = "{{ route('user.hapus', ':id') }}";
            urlDelete = urlDelete.replace(':id', id);
            $('#form-delete-akun').attr('action', urlDelete);
            $('#exampleModal').modal('show');
            $('#nama-akun').text(name);
        }

        // Cetak halaman khusus konten tabel
        document.getElementById('printBtn').addEventListener('click', function() {
            window.print();
        });

        @if (Session::get('failed'))
            $(document).ready(function() {
                let id = "{{ Session::get('id') }}";
                let stock = "{{ Session::get('stock') }}";
                showModalStock(id, stock);
            });
        @endif
    </script>
@endpush
