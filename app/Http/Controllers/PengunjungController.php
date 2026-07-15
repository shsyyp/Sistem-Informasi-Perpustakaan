<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengunjungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'pengunjung';

        $data = DB::select(DB::raw("select * from pengunjung"));

        return view('pengunjung.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = 'pengunjung';

        return view('pengunjung.create', compact('menu'));
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
            'jenis_pengunjung' => 'required',
            'nama'             => 'required',
            'asal'             => 'required',
            'tujuan'           => 'required',
        ]);

        DB::insert("INSERT INTO `pengunjung` (`id`,`jenis_pengunjung`,`nama`,`asal`,`tujuan`, `waktu_kunjungan`) values (uuid(),?,?,?,?,?)",
            [$request->jenis_pengunjung, $request->nama, $request->asal, $request->tujuan, date('Y-m-d H:i:s')]);

        return redirect()->route('pengunjung.index')->with(['success' => 'data berhasil disimpan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = 'pengunjung';

        $data = DB::table('pengunjung')->where('id', $id)->first();
        return view('pengunjung.edit', compact('menu', 'data'));
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
            'jenis_pengunjung' => 'required',
            'nama'             => 'required',
            'asal'             => 'required',
            'tujuan'           => 'required',
            'waktu_kunjungan'  => 'required',
        ]);

        $data = DB::table('pengunjung')->where('id', $id)->first();
        if (!$data)
            redirect()->route('pengunjung.index')->with(['error' => 'data tidak ditemukan!']);

        DB::update("UPDATE `pengunjung` SET `jenis_pengunjung`=?, `nama`=?, `asal`=?, `tujuan`=?, `waktu_kunjungan`=? WHERE id =?",
            [$request->jenis_pengunjung, $request->nama, $request->asal, $request->tujuan, $request->waktu_kunjungan, $id]);

        return redirect()->route('pengunjung.index')->with(['success' => 'data berhasil di update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pengunjung')->where('id', $id)->delete();
        return redirect()->route('pengunjung.index')->with(['success' => ' data berhasil dihapus']);
    }
}

