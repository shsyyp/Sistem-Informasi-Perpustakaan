@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Tambah Peminjaman Buku</h5>
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
            <form action="{{ route('peminjaman.store') }}" class="form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Anggota</label>
                            <select name="anggota_id" class="form-control @error('anggota_id') is-invalid @enderror">
                                <option value="">. . . . . .</option>
                                {{-- Loop to populate options with member data --}}
                                @foreach ($anggotaList as $member)
                                    <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>{{ $member->nama }}</option>
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
                                <option value="">. . . . . .</option>
                                {{-- Loop to populate options with exemplar data --}}
                                @foreach ($eksemplarList as $exemplar)
                                    <option value="{{ $exemplar->id }}" {{ old('exemplar_id') == $exemplar->id ? 'selected' : '' }}>{{ $exemplar->kode_eksemplar . ' - ' . $exemplar->judul }}</option>
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
                            <input type="datetime-local" class="form-control @error('tanggal_pinjam') is-invalid @enderror" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d\TH:i')) }}">
                            <!-- error message for tanggal_pinjam -->
                            @error('tanggal_pinjam')
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
