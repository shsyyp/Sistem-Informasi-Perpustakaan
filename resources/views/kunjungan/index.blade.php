<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kunjungan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                        <a href="{{ route('kunjungan.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">USERNAME</th>
                                    <th scope="col">TANGGAL DAN WAKTU</th>
                                    <th scope="col">TUJUAN</th>
                                    <th scope="col">KESAN DAN PESAN</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($data as $kunjungan)
                                <tr>
                                    <td>
                                    {{ $kunjungan->username}}</td>
                                    <td>{{$kunjungan->tgl_waktu}}</td>
                                    <td>{{$kunjungan->tujuan}}</td>
                                    <td>{{$kunjungan->kesan_pesan}}</td>

                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{route('kunjungan.destroy', $kunjungan->id) }}" method="post">
                                            <a href="{{route('kunjungan.edit', $kunjungan->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data kunjungan belum tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        //message with toastr
        @if(session() -> has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif(session() -> has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
</body>
</html>