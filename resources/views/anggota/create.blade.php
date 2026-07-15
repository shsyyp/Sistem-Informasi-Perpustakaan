@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Tambah Anggota Pustaka</h5>
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
            <form action="{{ route('anggota.store') }}" class="form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Kode Anggota</label>
                            <input type="text" class="form-control text-uppercase @error('kode_anggota') is-invalid @enderror" minlength="5" name="kode_anggota" value="{{ old('kode_anggota') }}">
                            <!-- error message for kode_anggota -->
                            @error('kode_anggota')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Jenis Anggota</label>
                            <select name="jenis_anggota" class="form-control @error('jenis_anggota') is-invalid @enderror">
                                <option value="">. . . . . .</option>
                                <option value="Siswa" {{ old('jenis_anggota') == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                                <option value="Guru" {{ old('jenis_anggota') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                <option value="Umum" {{ old('jenis_anggota') == 'Umum' ? 'selected' : '' }}>Umum</option>
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
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}">
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
                                <option value="">. . . . . .</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
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
