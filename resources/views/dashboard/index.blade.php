@extends('layouts.app')

@section('contents')
    <div class="row">
        <div class="col-sm-6 col-lg-3 mb-4">
            <a href="{{ route('pengunjung.index') }}" class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-door-open"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $dataStatistik['kunjungan'] }}</h4>
                    </div>
                    <p class="mb-1">Kunjungan</p>
                    <p class="mb-0">
                        <small class="text-muted">total seluruh kunjungan yang tercatat</small>
                    </p>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <a href="{{ route('buku.index') }}" class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bxs-bookmarks"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $dataStatistik['buku'] }}</h4>
                    </div>
                    <p class="mb-1">Judul Buku</p>
                    <p class="mb-0">
                        <small class="text-muted">jumlah seluruh judul buku yang sudah diinputkan</small>
                    </p>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <a href="{{ route('eksemplar.index') }}" class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-book-bookmark"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $dataStatistik['eksemplar'] }}</h4>
                    </div>
                    <p class="mb-1">Eksemplar Buku</p>
                    <p class="mb-0">
                        <small class="text-muted">total eksemplar dari judul buku yang ada</small>
                    </p>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <a href="{{ route('peminjaman.index') }}" class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-share-alt"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $dataStatistik['dipinjam'] }}</h4>
                    </div>
                    <p class="mb-1">Buku Dipinjam</p>
                    <p class="mb-0">
                        <small class="text-muted">jumlah eksemplar buku yang sedang dipinjam</small>
                    </p>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user-check"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">Statistik Pengunjung</h4>
                    </div>
                    <div class="col-md-12">
                        <div id="chart-container" style="height: 300px"></div>
                    </div>
                </div>
            </div>
        </div>
</div>
        
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-user-plus"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">Top Peminjaman</h4>
                    </div>
                <div class="col-md-12">
                    <div class="overflow-auto" style="height: 300px">
                        <ul class="p-0 m-0">
                            @forelse ($dataPeminjaman as $item)
                                <li class="d-flex mb-1 pb-1">
                                    <div class="avatar flex-shrink-0">
                                        <i class="bx bx-user"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">{{ $item->jenis_anggota . ' - ' . $item->kode_anggota }}</small>
                                            <h6 class="mb-0">{{ $item->nama }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-primary">{{ $item->jumlah }}</h6>
                                            <span class="text-muted">Buku</span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <span>Data belum ada</span>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card card-border-shadow-info h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-user-check"></i></span>
                    </div>
                    <h4 class="ms-1 mb-0 fw-bold">Top Pengunjung</h4>
                </div>
                <div class="col-md-12">
                    <div class="overflow-auto" style="height: 300px">
                        <ul class="p-0 m-0">
                            @forelse ($dataPengunjung as $visitor)
                                <li class="d-flex mb-1 pb-1">
                                    <div class="avatar flex-shrink-0">
                                        <i class="bx bx-user"></i>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">{{ $visitor->jenis_pengunjung . ' - ' . $visitor->id_tamu }}</small>
                                            <h6 class="mb-0">{{ $visitor->nama }}</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0 text-primary">{{ $visitor->jumlah_kunjungan }}</h6>
                                            <span class="text-muted">Kunjungan</span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <span>Data belum ada</span>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <script>
        $('#table').DataTable();

        var dom = document.getElementById('chart-container');
        var myChart = echarts.init(dom, null, {
            renderer: 'canvas',
            useDirtyRect: false
        });
        var app = {};

        var option;

        option = {
            xAxis: {
                type: 'category',
                data: {!! json_encode($grafikPeminjaman['category']) !!}
            },
            yAxis: {
                type: 'value'
            },
            series: [{
                data: {!! json_encode($grafikPeminjaman['value']) !!},
                type: 'line'
            }]
        };


        if (option && typeof option === 'object') {
            myChart.setOption(option);
        }

        window.addEventListener('resize', myChart.resize);
    </script>
@endpush
