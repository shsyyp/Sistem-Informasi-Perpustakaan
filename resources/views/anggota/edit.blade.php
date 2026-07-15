@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Edit Anggota Pustaka</h5>
            </div>
            <div class="text-end pt-3 pt-md-0">
                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
                    <span>
                        <i class="bx bx-left-arrow-alt me-sm-1"></i> <span class="d-none d-sm-inline-block">Kembali</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <form action="{{ route('anggota.update', $data->id) }}" class="form" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Kode Anggota</label>
                            <input type="text" class="form-control" value="{{ $data->kode_anggota }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Jenis Anggota</label>
                            <select name="jenis_anggota" class="form-control @error('jenis_anggota') is-invalid @enderror">
                                <option value="Siswa" {{ $data->jenis_anggota == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                                <option value="Guru" {{ $data->jenis_anggota == 'Guru' ? 'selected' : '' }}>Guru</option>
                                <option value="Umum" {{ $data->jenis_anggota == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            <!-- error message for jenis_anggota -->
                            @error('jenis_anggota')
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
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data->nama }}">
                            <!-- error message for nama -->
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="Laki-laki" {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <!-- error message for jenis_kelamin -->
                            @error('jenis_kelamin')
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
