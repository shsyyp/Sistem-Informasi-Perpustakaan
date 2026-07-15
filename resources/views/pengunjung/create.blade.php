@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Tambah Pengunjung</h5>
            </div>
            <div class="text-end pt-3 pt-md-0">
                <a href="{{ route('pengunjung.index') }}" class="btn btn-secondary">
                    <span>
                        <i class="bx bx-left-arrow-alt me-sm-1"></i> <span class="d-none d-sm-inline-block">Kembali</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <form action="{{ route('pengunjung.store') }}" class="form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Jenis Pengunjung</label>
                            <select name="jenis_pengunjung" class="form-control @error('jenis_pengunjung') is-invalid @enderror">
                                <option value="">. . . . . .</option>
                                <option value="Siswa" {{ old('jenis_pengunjung') == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                                <option value="Guru" {{ old('jenis_pengunjung') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                <option value="Umum" {{ old('jenis_pengunjung') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            <!-- error message for jenis_pengunjung -->
                            @error('jenis_pengunjung')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
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
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Asal</label>
                            <input type="text" class="form-control @error('asal') is-invalid @enderror" name="asal" placeholder="Kelas/Bagian/Institusi" value="{{ old('asal') }}">
                            <!-- error message for asal -->
                            @error('asal')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Tujuan</label>
                            <input type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" value="{{ old('tujuan') }}">
                            <!-- error message for tujuan -->
                            @error('tujuan')
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
