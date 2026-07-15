@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Data Eksemplar Pustaka</h5>
            </div>
            <div class="text-end pt-3 pt-md-0">
                <a href="{{ route('eksemplar.create') }}" class="btn btn-primary">
                    <span>
                        <i class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Eksemplar</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="card-datatable table-responsive px-4 pb-4">
            <table class="table border-top" id="table">
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th>Pengarang</th>
                        <th>Kode Eksemplar</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $eksemplar)
                        <tr>
                            <td>{{ $eksemplar->judul }}</td>
                            <td>{{ $eksemplar->pengarang }}</td>
                            <td>{{ $eksemplar->kode_eksemplar }}</td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('eksemplar.edit', $eksemplar->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('eksemplar.destroy', $eksemplar->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
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
