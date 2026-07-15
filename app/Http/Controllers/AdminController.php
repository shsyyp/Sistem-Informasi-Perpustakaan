<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'admin';

        $data = DB::select(DB::raw("select * from admin"));

        return view('admin.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = 'admin';

        return view('admin.create', compact('menu'));
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
            'nama'     => 'required',
            'jk'       => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        DB::insert("INSERT INTO `admin` (`id`,`nama`,`jk`,`role`,`username`,`password`)values (uuid(),?,?,?,?,?)",
            [$request->nama, $request->jk, 'Admin', $request->username, Hash::make($request->password)]);
        return redirect()->route('admin.index')->with(['success' => 'data berhasil disimpan']);
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
        $menu = 'admin';

        $data = DB::table('admin')->where('id', $id)->first();
        return view('admin.edit', compact('menu', 'data'));
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
            'nama'     => 'required',
            'jk'       => 'required',
            'username' => 'required'
        ]);

        $data = DB::table('admin')->where('id', $id)->first();
        if (!$data)
            return redirect()->route('admin.index')->with(['error' => 'data tidak ditemukan!']);

        DB::update("UPDATE `admin` SET `nama`=?, `jk`=?, `role`=?, `username`=?, `password`=? WHERE id =?",
            [$request->nama, $request->jk, 'Admin', $request->username, ($request->password ? Hash::make($request->password) : $data->password), $id]);

        return redirect()->route('admin.index')->with(['success' => 'data berhasil di update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        DB::table('admin')->where('id', $id)->delete();
        // //redirect to index
        return redirect()->route('admin.index')->with(['success' => ' data berhasil dihapus']);
    }
}
