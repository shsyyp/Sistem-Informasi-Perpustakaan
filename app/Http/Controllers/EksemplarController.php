<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EksemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'eksemplar';

        $data = DB::select(DB::raw("select *, eksemplar.id from eksemplar join buku where buku.id = eksemplar.buku_id"));

        return view('eksemplar.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu     = 'eksemplar';
        $bukuList = DB::select(DB::raw("select * from buku"));

        return view('eksemplar.create', compact('menu', 'bukuList'));
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
            'buku_id'        => 'required',
            'kode_eksemplar' => 'required',
        ]);

        DB::insert("INSERT INTO `eksemplar` (`id`,`buku_id`,`kode_eksemplar`) values (uuid(),?,?)",
            [$request->buku_id, $request->kode_eksemplar]);

        return redirect()->route('eksemplar.index')->with(['success' => 'data berhasil disimpan']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu     = 'eksemplar';
        $bukuList = DB::select(DB::raw("select * from buku"));

        $data = DB::table('eksemplar')->where('id', $id)->first();
        return view('eksemplar.edit', compact('menu', 'data', 'bukuList'));
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
            'buku_id'        => 'required',
            'kode_eksemplar' => 'required',
        ]);

        $data = DB::table('eksemplar')->where('id', $id)->first();
        if (!$data)
            redirect()->route('eksemplar.index')->with(['error' => 'data tidak ditemukan!']);

        DB::update("UPDATE `eksemplar` SET `buku_id`=?, `kode_eksemplar`=? WHERE id =?",
            [$request->buku_id, $request->kode_eksemplar, $id]);

        return redirect()->route('eksemplar.index')->with(['success' => 'data berhasil di update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('eksemplar')->where('id', $id)->delete();
        return redirect()->route('eksemplar.index')->with(['success' => ' data berhasil dihapus']);
    }
}

