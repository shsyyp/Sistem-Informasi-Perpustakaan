<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'peminjaman';

        $data = DB::select(DB::raw("
            select *, peminjaman.id
            from peminjaman
            join anggota on anggota.id = peminjaman.anggota_id
            join eksemplar on eksemplar.id = peminjaman.eksemplar_id
            join buku on buku.id = eksemplar.buku_id
        "));

        return view('peminjaman.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu          = 'peminjaman';
        $anggotaList   = DB::select(DB::raw("select * from anggota"));
        $eksemplarList = DB::select(DB::raw("
            select eksemplar.id, kode_eksemplar, judul 
            from eksemplar 
            join buku on buku.id = eksemplar.buku_id 
            where eksemplar.id not in (select eksemplar_id from peminjaman where status = 'Pinjam')
        "));

        return view('peminjaman.create', compact('menu', 'anggotaList', 'eksemplarList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'anggota_id'     => 'required',
            'eksemplar_id'   => 'required',
            'tanggal_pinjam' => 'required|date'
        ]);

        DB::insert("INSERT INTO `peminjaman` (`id`,`anggota_id`,`eksemplar_id`,`tanggal_pinjam`,`status`) values (uuid(),?,?,?,?)",
            [$request->anggota_id, $request->eksemplar_id, $request->tanggal_pinjam, 'Pinjam']);

        return redirect()->route('peminjaman.index')->with(['success' => 'data berhasil disimpan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu          = 'peminjaman';
        $anggotaList   = DB::select(DB::raw("select * from anggota"));
        $eksemplarList = DB::select(DB::raw("select eksemplar.id, kode_eksemplar, judul from eksemplar join buku where buku.id = eksemplar.buku_id"));

        $data = DB::table('peminjaman')->where('id', $id)->first();
        return view('peminjaman.edit', compact('menu', 'data', 'anggotaList', 'eksemplarList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'anggota_id'     => 'required',
            'eksemplar_id'   => 'required',
            'tanggal_pinjam' => 'required|date'
        ]);

        $data = DB::table('peminjaman')->where('id', $id)->first();
        if (!$data)
            redirect()->route('peminjaman.index')->with(['error' => 'data tidak ditemukan!']);

        DB::update("UPDATE `peminjaman` SET `anggota_id`=?, `eksemplar_id`=?, `tanggal_pinjam`=?, `tanggal_kembali`=?, `status`=? WHERE id =?",
            [$request->anggota_id, $request->eksemplar_id, $request->tanggal_pinjam, $request->tanggal_kembali, ($request->tanggal_kembali ? 'Kembali' : 'Pinjam'), $id]);

        return redirect()->route('peminjaman.index')->with(['success' => 'data berhasil di update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('peminjaman')->where('id', $id)->delete();
        return redirect()->route('peminjaman.index')->with(['success' => ' data berhasil dihapus']);
    }
}

