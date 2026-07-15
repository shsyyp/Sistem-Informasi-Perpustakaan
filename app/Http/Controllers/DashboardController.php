<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'dashboard';

        $dataStatistik = [
            'kunjungan' => DB::select(DB::raw("select count(*) as jumlah from pengunjung"))[0]->jumlah,
            'buku'      => DB::select(DB::raw("select count(*) as jumlah from buku"))[0]->jumlah,
            'eksemplar' => DB::select(DB::raw("select count(*) as jumlah from eksemplar"))[0]->jumlah,
            'dipinjam'  => DB::select(DB::raw("select count(*) as jumlah from peminjaman where status = 'Pinjam'"))[0]->jumlah,
        ];

        $dataPeminjaman = DB::select(DB::raw("
            select kode_anggota, nama, jenis_anggota, count(p.id) jumlah
            from anggota a
            join peminjaman p on p.anggota_id = a.id
            group by kode_anggota, nama, jenis_anggota
            order by count(p.id) desc
            limit 10
        "));

        $dataPengunjung = DB::select(DB::raw("
            SELECT id_tamu, nama, jenis_pengunjung, COUNT(id) jumlah_kunjungan
            FROM pengunjung
            GROUP BY id_tamu, nama, jenis_pengunjung
            ORDER BY COUNT(id) DESC
            LIMIT 10
        "));
    
        $statistikPeminjaman = DB::select(DB::raw("
            select date(tanggal_pinjam) tgl, count(id) jumlah
            from peminjaman
            group by date(tanggal_pinjam)
            order by date(tanggal_pinjam) desc
            limit 10
        "));

        $grafikPeminjaman = ['category' => [], 'value' => []];
        foreach ($statistikPeminjaman as $key => $value) {
            $grafikPeminjaman['category'][] = $value->tgl;
            $grafikPeminjaman['value'][]    = $value->jumlah;
        }

        return view('dashboard.index', compact('menu', 'dataStatistik', 'dataPeminjaman', 'dataPengunjung','grafikPeminjaman'));
    }
}
