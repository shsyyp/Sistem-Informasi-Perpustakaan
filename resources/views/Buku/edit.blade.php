@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Edit Buku</h5>
            </div>
            <div class="text-end pt-3 pt-md-0">
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                    <span>
                        <i class="bx bx-left-arrow-alt me-sm-1"></i> <span class="d-none d-sm-inline-block">Kembali</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <form action="{{ route('buku.update', $data->id) }}" class="form" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ $data->judul }}">
                            <!-- error message for judul -->
                            @error('judul')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Pengarang</label>
                            <input type="text" class="form-control @error('pengarang') is-invalid @enderror" name="pengarang" value="{{ $data->pengarang }}">
                            <!-- error message for pengarang -->
                            @error('pengarang')
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
                            <label class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control @error('th_terbit') is-invalid @enderror" name="th_terbit" value="{{ $data->th_terbit }}">
                            <!-- error message for th_terbit -->
                            @error('th_terbit')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" value="{{ $data->penerbit }}">
                            <!-- error message for penerbit -->
                            @error('penerbit')
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
                            <label class="form-label">ISBN</label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" value="{{ $data->isbn }}">
                            <!-- error message for isbn -->
                            @error('isbn')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" value="{{ $data->kategori }}">
                            <!-- error message for kategori -->
                            @error('kategori')
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
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" value="{{ $data->lokasi }}">
                            <!-- error message for lokasi -->
                            @error('lokasi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar">
                            <!-- error message for gambar -->
                            @error('gambar')
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
