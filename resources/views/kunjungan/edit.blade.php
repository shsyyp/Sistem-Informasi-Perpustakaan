<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Kunjungan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('kunjungan.update',$data->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username"  value="{{ $data->username }}">
                                <!-- error message untuk username -->
                                @error('username')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal dan Waktu</label>
                                <input type="datetime-local" class="form-control @error('tgl_waktu') is-invalid @enderror"
                                    name="tgl_waktu"  value="{{ $data->tgl_waktu }}">
                                <!-- error message untuk tgl_waktu -->
                                @error('tgl_waktu')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tujuan</label>
                                <input type="text" class="form-control @error('tujuan') is-invalid @enderror" 
                                    name="tujuan" value="{{ $data->tujuan}}">
                                <!-- error message untuk tujuan -->
                                @error('tujuan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Kesan dan Pesan</label>
                                <input type="text" class="form-control @error('kesan_pesan') is-invalid @enderror"
                                    name="kesan_pesan"  value="{{ $data->kesan_pesan }}">
                                <!-- error message untuk kesan_pesan -->
                                @error('kesan_pesan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">EDIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>
</html>