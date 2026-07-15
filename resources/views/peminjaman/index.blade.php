@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Data Peminjaman Buku</h5>
            </div>
            <div class="text-end pt-3 pt-md-0">
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                    <span>
                        <i class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Peminjaman</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="card-datatable table-responsive px-4 pb-4">
            <table class="table border-top" id="table">
                <thead>
                    <tr>
                        <th>Anggota ID</th>
                        <th>Judul</th>
                        <th>Kode Eksemplar</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $peminjaman)
                        <tr>
                            <td>{{ $peminjaman->nama }}</td>
                            <td>{{ $peminjaman->judul }}</td>
                            <td>{{ $peminjaman->kode_eksemplar }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_kembali ?? '-' }}</td>
                            <td><span class="badge bg-label-{{ $peminjaman->status == 'Pinjam' ? 'danger' : 'success' }}">{{ $peminjaman->status }}</span></td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('peminjaman.edit', $peminjaman->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection

@push('script')
    <script>
        $('#table').DataTable();
    </script>
@endpush
