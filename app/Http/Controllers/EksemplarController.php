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
            'buku_id' => 'required',
        ]);

        $kodeEksemplar = $this->generateKodeEksemplar($request->buku_id);

        DB::insert("INSERT INTO `eksemplar` (`id`,`buku_id`,`kode_eksemplar`) values (uuid(),?,?)",
            [$request->buku_id, $kodeEksemplar]);

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
            'buku_id' => 'required',
        ]);

        $data = DB::table('eksemplar')->where('id', $id)->first();
        if (!$data)
            redirect()->route('eksemplar.index')->with(['error' => 'data tidak ditemukan!']);

        $kodeEksemplar = $data->kode_eksemplar;
        if ($data->buku_id !== $request->buku_id) {
            $kodeEksemplar = $this->generateKodeEksemplar($request->buku_id, $id);
        }

        DB::update("UPDATE `eksemplar` SET `buku_id`=?, `kode_eksemplar`=? WHERE id =?",
            [$request->buku_id, $kodeEksemplar, $id]);

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
        $eksemplar = DB::table('eksemplar')->where('id', $id)->first();
        if (!$eksemplar) {
            return redirect()->route('eksemplar.index')->with(['error' => 'data tidak ditemukan!']);
        }

        $jumlahPeminjaman = DB::table('peminjaman')->where('eksemplar_id', $id)->count();
        if ($jumlahPeminjaman > 0) {
            return redirect()->route('eksemplar.index')->with([
                'error' => 'Eksemplar ' . $eksemplar->kode_eksemplar . ' tidak dapat dihapus karena sudah memiliki riwayat peminjaman.'
            ]);
        }

        DB::table('eksemplar')->where('id', $id)->delete();
        return redirect()->route('eksemplar.index')->with(['success' => ' data berhasil dihapus']);
    }

    private function generateKodeEksemplar($bukuId, $excludeId = null)
    {
        $query = DB::table('eksemplar')
            ->where('buku_id', $bukuId)
            ->whereNotNull('kode_eksemplar');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $existingCodes = $query->pluck('kode_eksemplar');
        $prefix = null;
        $maxNumber = 0;

        foreach ($existingCodes as $code) {
            if (preg_match('/^(.+)-(\d+)$/', $code, $matches)) {
                $prefix = $matches[1];
                $maxNumber = max($maxNumber, (int) $matches[2]);
            }
        }

        if (!$prefix) {
            $usedBookCount = DB::table('eksemplar')->distinct('buku_id')->count('buku_id');
            $prefix = 'BK' . ($usedBookCount + 1);
        }

        return $prefix . '-' . str_pad($maxNumber + 1, 3, '0', STR_PAD_LEFT);
    }
}
