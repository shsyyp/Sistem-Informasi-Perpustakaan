<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::select(DB::raw("select*from kunjungan"));
        return view ('kunjungan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kunjungan.create');
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
            'username' => 'required',
            'tgl_waktu' => 'required',
            'tujuan' => 'required',
            'kesan_pesan' => 'required'
        ]);
        
        DB::insert("INSERT INTO `kunjungan` (`id`,`username`,`tgl_waktu`,`tujuan`,`kesan_pesan`)values (uuid(),?,?,?,?)",
        [$request->username,$request->tgl_waktu,$request->tujuan,$request->kesan_pesan]);
        return redirect()->route('kunjungan.index')->with(['success' => 'data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $data=DB::table('kunjungan')->where('id',$id)->first();
        return view('kunjungan.edit',compact('data'));
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
        $this->validate($request,[
            'username' => 'required',
            'tgl_waktu' => 'required',
            'tujuan' => 'required',
            'kesan_pesan' => 'required'
        ]);

        DB::update("UPDATE `kunjungan` SET `username`=?, `tgl_waktu`=?, `tujuan`=?, `kesan_pesan`=? WHERE id =?",
        [$request->username,$request->tgl_waktu,$request->tujuan,$request->kesan_pesan,$id]);
        return redirect()->route('kunjungan.index')->with(['success' => 'data berhasil di update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        DB::table('kunjungan')->where('id',$id)->delete();
        //redirect to index
        return redirect()->route('kunjungan.index')->with(['success'=>' data berhasil dihapus']);
    }
}