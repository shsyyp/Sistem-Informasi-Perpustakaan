<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name') }}</title>


    <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/">

    {{-- menambahkan file views/layout/css.blade.php disini --}}
    @include('layouts.css')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Content wrapper -->
            <div class="content-wrapper px-4">
                <!-- Content -->
                <div class="container-xxl- flex-grow-1 container-p-y">

                    <div class="d-flex flex-column w-100 h-100 bg-light shadow rounded  position-relative">

                        <div class="d-flex w-100 p-4">
                            <div class="d-flex flex-grow-1">
                                <img src="{{ asset('assets/img/icons/logo.png') }}" alt="" style="width: 75px; height: auto;">
                            </div>
                            <div class="d-flex text-end">
                                <div>
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login Pustakawan</a>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-grow-1 p-4 ms-md-5 ps-md-5 mb-md-5">
                            <div class="d-flex flex-column w-100 h-100 justify-content-center">
                                <h1 class="fw-bolder fs-1">Tingkatkan Pengetahuan dan Imajinasi Anda</h1>
                                <h1 class="fw-bolder fs-1">di Perpustakaan Sekolah Kami</h1>
                                <div class="my-5 fs-5">
                                    Temukan koleksi buku terbaru, akses sumber daya digital,<br>
                                    dan jadwal kunjungan Anda sekarang.<br>
                                    Selamat datang di dunia pengetahuan.
                                </div>
                                <div class="">
                                    <button data-bs-toggle="modal" data-bs-target="#cari-buku" class="btn btn-xl btn-primary mb-3 mb-md-0"> Cari Buku <i class="bx bx-search ms-3"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#buku-tamu" class="btn btn-xl btn-dark ms-md-3"> Isi Buku Pengunjung <i class="bx bx-book ms-3"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="position-absolute w-50 h-75 bottom-0 end-0 align-items-end justify-content-center d-none d-md-flex">
                            <img src="{{ asset('assets/img/home.png') }}" alt="" class="w-100">
                        </div>
                    </div>

                </div>
                <!-- / Content -->

                {{-- MODAL BUKU --}}
                <div class="modal fade" id="cari-buku" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFullTitle">Cari Buku</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table border-top" id="table">
                                    <thead>
                                        <tr>
                                            <th width="10%">Sampul</th>
                                            <th width="70%">Detail</th>
                                            <th width="20%">Ketersediaan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($dataBuku as $buku)
                                            <tr>
                                                <td width="10%" class="align-top"><img src="{{ asset('images') . '/' . $buku->gambar }}" alt="" class="border rounded" width="150px"></td>
                                                <td class="align-top">
                                                    <table>
                                                        <tr>
                                                            <td>Judul</td>
                                                            <td class="px-2">:</td>
                                                            <td><strong>{{ $buku->judul }}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pengarang</td>
                                                            <td class="px-2">:</td>
                                                            <td>{{ $buku->pengarang }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tahun Terbit</td>
                                                            <td class="px-2">:</td>
                                                            <td>{{ $buku->th_terbit }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="20%" class="align-top">
                                                    <table>
                                                        <tr>
                                                            <td>Eksemplar</td>
                                                            <td class="px-2">:</td>
                                                            <td><strong>{{ $buku->jumlah_eksemplar }} Buah</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dipinjam</td>
                                                            <td class="px-2">:</td>
                                                            <td>{{ $buku->jumlah_dipinjam }} Buah</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tersedia</td>
                                                            <td class="px-2">:</td>
                                                            <td>{{ $buku->jumlah_eksemplar - $buku->jumlah_dipinjam }} Buah</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL KUNJUNGAN --}}
                <div class="modal fade" id="buku-tamu" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFullTitle">Buku Tamu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('kunjungan') }}" class="form" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Jenis Pengunjung</label>
                                                <select name="jenis_pengunjung" id="jenis_pengunjung" class="form-control @error('jenis_pengunjung') is-invalid @enderror" required>
                                                    <option value="">. . . . . .</option>
                                                    <option value="Siswa">Siswa</option>
                                                    <option value="Guru">Guru</option>
                                                    <option value="Umum">Umum</option>
                                                </select>
                                                <!-- error message for jenis_pengunjung -->
                                                @error('jenis_pengunjung')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="idField" hidden>
                                            <div class="form-group mb-3">
                                            <label class="form-label" id="idLabel" >Identitas</label>
                                                <input type="text" class="form-control @error('id') is-invalid @enderror" name="id_tamu" id="id_tamu" placeholder="............." required>
                                                <!-- error message for id -->
                                                @error('id')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="namaField" hidden>
                                            <div class="form-group mb-3">
                                            <label class="form-label" id="namaLabel" >Nama</label>
                                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" required>
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
                                    <div class="col-md-12" id="asalField" hidden>
                                            <div class="form-group mb-3">
                                                <label class="form-label" id="AsalLabel">Asal</label>
                                                <input type="text" class="form-control @error('asal') is-invalid @enderror" name="asal" id="asal" required>
                                                <!-- error message for asal -->
                                                @error('asal')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="tujuanField" hidden>
                                            <div class="form-group mb-3">
                                                <label class="form-label">Tujuan Kunjungan</label>
                                                <input type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" required>
                                                <!-- error message for tujuan -->
                                                @error('tujuan')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="content-footer footer bg-primary rounded-top">
                    <div class="d-flex px-4 flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            , Kelompok 10 <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">ThemeSelection</a>
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    {{-- menmbahkan file views/layout/js.blade.php disini --}}
    @include('layouts.js')

    <script>
        $('#table').DataTable();

        $(document).on('change', '[name="jenis_pengunjung"]', function () {
            let jenis = $(this).val()

            $('[name="id_tamu"]').val('')
            $('[name="nama"]').val('')
            $('[name="asal"]').val('')

            $('#idField').prop('hidden', false)
            $('#namaField').prop('hidden', false)
            $('#asalField').prop('hidden', false)
            $('#tujuanField').prop('hidden', false)

            $('#idLabel').text(jenis == 'Siswa' ? 'NISN' : (jenis == 'Guru' ? 'NIP' : 'NIK')) 
            $('#AsalLabel').text(jenis == 'Siswa' ? 'Kelas' : (jenis == 'Guru' ? 'Bagian' : 'Asal')) 
        })

        $(document).on('keyup paste keydown', '[name="id_tamu"]', function () {
            let jenis = $('[name="jenis_pengunjung"]').val() 

                let id = $('[name="id_tamu"]').val()
                $.ajax({
                    url: `{{route('getmember')}}`,
                    type: 'GET',
                    data: {
                        kode_anggota: id,
                        jenis_anggota: jenis
                    },  
                    dataType: "json",
                    success: function (resp) {
                        if (resp) {
                            $('[name="nama"]').val(resp.nama)
                        } else {
                            $('[name="nama"]').val('')
                        }
                    }
                })
        })
    </script>

    <!-- Tambahkan script berikut di akhir bagian body HTML Anda -->
    
</body>

</html>

<!-- beautify ignore:end -->
