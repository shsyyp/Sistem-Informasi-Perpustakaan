<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $menu = 'dashboard';

        $dataBuku = DB::select(DB::raw("
            select buku.*,
                   (select count(*) from eksemplar where buku_id = buku.id) as jumlah_eksemplar,
                   (select count(*) from eksemplar where buku_id = buku.id and id in (select eksemplar_id from peminjaman where status = 'Pinjam')) as jumlah_dipinjam
            from buku
        "));

        return view('home', compact('dataBuku'));
    }

    public function kunjungan(Request $request)
    {
        $this->validate($request, [
            'id_tamu' => 'required',
            'jenis_pengunjung' => 'required',
            'nama'             => 'required',
            'asal'             => 'required',
            'tujuan'           => 'required',
        ]);

        DB::insert("INSERT INTO `pengunjung` (`id`, `id_tamu`, `jenis_pengunjung`,`nama`,`asal`,`tujuan`, `waktu_kunjungan`) values (uuid(),?,?,?,?,?,?)",
            [$request->id_tamu, $request->jenis_pengunjung, $request->nama, $request->asal, $request->tujuan, date('Y-m-d H:i:s')]);

        return redirect()->route('home.index')->with(['success' => 'kunjungan berhasil disimpan']);
    }

    public function getmember(Request $request)
    {
        $jenis_anggota = $request->input('jenis_anggota');
        $keyword = $request->input('keyword', $request->input('kode_anggota'));

        if (!$jenis_anggota || !$keyword) {
            return response()->json(null);
        }

        $data = DB::table('anggota')
            ->where('jenis_anggota', $jenis_anggota)
            ->where(function ($query) use ($keyword) {
                $query->where('kode_anggota', $keyword)
                    ->orWhere('nama', 'like', '%' . $keyword . '%');
            })
            ->orderByRaw("CASE WHEN kode_anggota = ? THEN 0 ELSE 1 END", [$keyword])
            ->first();

        return response()->json($data);
    }
}
