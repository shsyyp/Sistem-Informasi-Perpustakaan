@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Edit Peminjaman Buku</h5>
            </div>
            <div class="text-end pt-3 pt-md-0">
                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                    <span>
                        <i class="bx bx-left-arrow-alt me-sm-1"></i> <span class="d-none d-sm-inline-block">Kembali</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <form action="{{ route('peminjaman.update', $data->id) }}" class="form" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Anggota</label>
                            <select name="anggota_id" class="form-control @error('anggota_id') is-invalid @enderror">
                                @foreach ($anggotaList as $anggota)
                                    <option value="{{ $anggota->id }}" {{ $data->anggota_id == $anggota->id ? 'selected' : '' }}>{{ $anggota->nama }}</option>
                                @endforeach
                            </select>
                            <!-- error message for anggota_id -->
                            @error('anggota_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Eksemplar</label>
                            <select name="eksemplar_id" class="form-control @error('eksemplar_id') is-invalid @enderror">
                                @foreach ($eksemplarList as $eksemplar)
                                    <option value="{{ $eksemplar->id }}" {{ $data->eksemplar_id == $eksemplar->id ? 'selected' : '' }}>{{ $eksemplar->kode_eksemplar . ' - ' . $eksemplar->judul }}</option>
                                @endforeach
                            </select>
                            <!-- error message for eksemplar_id -->
                            @error('eksemplar_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="datetime-local" class="form-control datepicker @error('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" value="{{ $data->tanggal_pinjam }}">
                            <!-- error message for tanggal_pinjam -->
                            @error('tanggal_pinjam')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Kembali</label>
                            <input type="datetime-local" class="form-control datepicker @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" value="{{ $data->tanggal_kembali }}">
                            <small>diisi jika sudah dikembalikan</small>
                            <!-- error message for tanggal_kembali -->
                            @error('tanggal_kembali')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end pt-4">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection

@push('script')
    <script>
        // Your datepicker initialization script here
        // Example: $('.datepicker').datepicker();
    </script>
@endpush
