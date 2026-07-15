<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'buku';

        $data = DB::select(DB::raw("select * from buku"));

        return view('buku.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
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
            'judul'     => 'required',
            'pengarang' => 'required',
            'th_terbit' => 'required|integer',
            'penerbit'  => 'required',
            'isbn'      => 'required',
            'kategori'  => 'required',
            'lokasi'    => 'required',
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambar      = $request->file('gambar');
        $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
        $gambar->move(public_path('images'), $nama_gambar);

        DB::insert("INSERT INTO `buku` (`id`,`judul`,`pengarang`,`th_terbit`,`penerbit`,`isbn`,`kategori`,`lokasi`,`gambar`)values (uuid(),?,?,?,?,?,?,?,?)",
            [$request->judul, $request->pengarang, $request->th_terbit, $request->penerbit, $request->isbn, $request->kategori, $request->lokasi, $nama_gambar]);
        return redirect()->route('buku.index')->with(['success' => 'data berhasil disimpan']);
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
        $menu = 'buku';

        $data = DB::table('buku')->where('id', $id)->first();
        return view('buku.edit', compact('menu', 'data'));
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
            'judul'     => 'required',
            'pengarang' => 'required',
            'th_terbit' => 'required|integer',
            'penerbit'  => 'required',
            'isbn'      => 'required',
            'kategori'  => 'required',
            'lokasi'    => 'required',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = DB::table('buku')->where('id', $id)->first();
        if (!$data)
            redirect()->route('buku.index')->with(['error' => 'data tidak ditemukan!']);

        $nama_gambar = $data->gambar;

        if ($request->hasFile('gambar')) {
            $gambar      = $request->file('gambar');
            $nama_gambar = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('images'), $nama_gambar);
        }

        DB::update("UPDATE `buku` SET `judul`=?, `pengarang`=?, `th_terbit`=?, `penerbit`=?, `isbn`=?, `kategori`=?, `lokasi`=?, `gambar`=? WHERE id =?",
            [$request->judul, $request->pengarang, $request->th_terbit, $request->penerbit, $request->isbn, $request->kategori, $request->lokasi, $nama_gambar, $id]);

        return redirect()->route('buku.index')->with(['success' => 'data berhasil di update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        DB::table('buku')->where('id', $id)->delete();
        //redirect to index
        return redirect()->route('buku.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
