@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Tambah Eksemplar Pustaka</h5>
            </div>
            <div class="text-end pt-3 pt-md-0">
                <a href="{{ route('eksemplar.index') }}" class="btn btn-secondary">
                    <span>
                        <i class="bx bx-left-arrow-alt me-sm-1"></i> <span class="d-none d-sm-inline-block">Kembali</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="card-body pt-0">
            <form action="{{ route('eksemplar.store') }}" class="form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Buku</label>
                            <select name="buku_id" class="form-select @error('buku_id') is-invalid @enderror">
                                <option value="">. . . . . .</option>
                                {{-- Loop to populate options with book data --}}
                                @foreach ($bukuList as $book)
                                    <option value="{{ $book->id }}" {{ old('buku_id') == $book->id ? 'selected' : '' }}>{{ $book->judul }}</option>
                                @endforeach
                            </select>
                            <!-- error message for buku_id -->
                            @error('buku_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Kode Eksemplar</label>
                            <input type="text" class="form-control @error('kode_eksemplar') is-invalid @enderror" name="kode_eksemplar" value="{{ old('kode_eksemplar') }}">
                            <!-- error message for kode_eksemplar -->
                            @error('kode_eksemplar')
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
