@extends('layouts.app')

@section('contents')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex flex-column flex-md-row p-4">
            <div class="d-flex flex-grow-1 head-label text-center">
                <h5 class="card-title mb-0">Data Anggota Pustaka</h5>
            </div>
            <div class="text-end pt-3 pt-md-0">
                <!-- Button trigger modal -->
                <a href="{{ asset('assets/template-member-import.xlsx') }}" target="_blank" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="bx bx-upload me-sm-1"></i> Import Data
                </a>
                <a href="{{ route('anggota.create') }}" class="btn btn-primary">
                    <span>
                        <i class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Anggota</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="card-datatable table-responsive px-4 pb-4">
            <table class="table border-top" id="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kode Anggota</th>
                        <th>Jenis Anggota</th>
                        <th>Jenis Kelamin</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $anggota)
                        <tr>
                            <td><strong>{{ $anggota->nama }}</strong></td>
                            <td>{{ $anggota->kode_anggota }}</td>
                            <td><i class="fa fa-user fa-md text-{{ $anggota->jenis_anggota == 'Guru' ? 'danger' : ($anggota->jenis_anggota == 'Umum' ? 'warning' : 'primary') }} me-3"></i> {{ $anggota->jenis_anggota }}</td>
                            <td>{{ $anggota->jenis_kelamin }}</td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('anggota.edit', $anggota->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('anggota.destroy', $anggota->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Import Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="" class="btn btn-outline btn-outline-secondary text-success mb-4 w-100">Format File Import</a>
                        <input type="file" id="fileInput" class="form-control" accept=".xlsx">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="importData()">
                            <div class="spinner-border text-white import-loading d-none spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div> Proses
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--/ Basic Bootstrap Table -->
@endsection

@push('script')
    <script src="{{ asset('assets/js/xlsx.js') }}"></script>
    <script>
        $('#table').DataTable();

        function importData() {
            var fileInput = document.getElementById('fileInput');
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var data = new Uint8Array(e.target.result);
                    var workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    // Proses JSON
                    var jsonData = XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]]);

                    // Lakukan validasi dan kirim data ke controller jika sesuai
                    validateAndSendData(jsonData);
                };

                reader.readAsArrayBuffer(file);
            } else {
                toastr.error('Tidak ada file terpilih', 'GAGAL!');
            }
        }

        function validateAndSendData(jsonData) {
            // Lakukan validasi sesuai kebutuhan
            valid = true
            if (!isValidData(jsonData)) {
                valid = false
                return false;
            }

            if (valid) {
                // Dapatkan CSRF token dari meta tag di halaman
                var csrfToken = '{{ csrf_token() }}';
                $('.import-loading').removeClass('d-none')

                // Kirim data ke controller menggunakan jQuery Ajax
                $.ajax({
                    url: "{{ url('anggota/import') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        jsonData: JSON.stringify(jsonData)
                    },
                    success: function(response) {
                        // Tampilkan jumlah data yang berhasil diimpor
                        toastr.success('Jumlah data yang berhasil diimpor: ' + response.jumlahData, 'SUCCESS!');
                        setTimeout(function() {
                            location.reload()
                        }, 1000);
                    },
                    error: function(error) {
                        $('.import-loading').addClass('d-none')
                        toastr.error('Terjadi kesalahan saat mengimpor data \n' + error.responseJSON.message, 'GAGAL!');
                    }
                });
            }
        }

        function isValidData(jsonData) {
            // Pastikan jumlah kolom sesuai
            if (jsonData.length === 0) {
                toastr.error('Data Kosong', 'GAGAL!');
                return false;
            }

            // Definisikan format yang diharapkan
            const expectedColumns = ['kode_anggota', 'jenis_anggota', 'nama', 'jenis_kelamin'];

            // Periksa jumlah kolom
            const firstRowColumns = Object.keys(jsonData[0]);
            if (firstRowColumns.length !== expectedColumns.length) {
                toastr.error('Kolom-kolom import tidak sesuai template', 'GAGAL!');
                return false;
            }

            kolomSesuai = true;
            expectedColumns.forEach(element => {
                if (!firstRowColumns.includes(element)) {
                    toastr.error(`Kolom ${element} tidak ada`, 'GAGAL!');
                    kolomSesuai = false
                }
                if (!kolomSesuai) return false
            });

            if (kolomSesuai) {
                allOk = true
                // Periksa setiap baris data
                for (const data of jsonData) {
                    // Pastikan kolom keempat isinya hanya "siswa" atau "guru"
                    if (!['Siswa', 'Guru', 'Umum'].includes(data.jenis_anggota)) {
                        toastr.error('Isi kolom jenis anggota hanya boleh (Siswa,Guru,Umum)', 'GAGAL!');
                        allOk = false
                    }
                    if (!['Laki-laki', 'Perempuan'].includes(data.jenis_kelamin)) {
                        toastr.error('Isi kolom jenis anggota hanya boleh (Laki-laki, Perempuan)', 'GAGAL!');
                        allOk = false
                    }

                    // Pastikan jumlah kolom sesuai
                    const currentRowColumns = Object.keys(data);
                    if (currentRowColumns.length !== expectedColumns.length) {
                        toastr.error('Seluruh kolom pada template wajib diisi', 'GAGAL!');
                        allOk = false
                    }
                }

                return allOk;
            }
        }
    </script>
@endpush
