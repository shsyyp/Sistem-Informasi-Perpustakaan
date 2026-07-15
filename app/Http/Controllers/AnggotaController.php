<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = 'anggota';

        $data = DB::select(DB::raw("select * from anggota"));

        return view('anggota.index', compact('menu', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = 'anggota';

        return view('anggota.create', compact('menu'));
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
            'jenis_anggota' => 'required',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $kodeAnggota = $this->generateKodeAnggota($request->jenis_anggota);

        DB::insert("INSERT INTO `anggota` (`id`,`kode_anggota`,`jenis_anggota`,`nama`,`jenis_kelamin`)values (uuid(),?,?,?,?)",
            [$kodeAnggota, $request->jenis_anggota, $request->nama, $request->jenis_kelamin]);
        return redirect()->route('anggota.index')->with(['success' => 'data berhasil disimpan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $jsonData = json_decode($request->input('jsonData'), true);

        $insertedDataCount = 0;

        foreach ($jsonData as $data) {
            $kodeAnggota = $this->generateKodeAnggota($data['jenis_anggota']);

            DB::insert("INSERT INTO `anggota` (`id`,`kode_anggota`,`jenis_anggota`,`nama`,`jenis_kelamin`)values (uuid(),?,?,?,?)",
                [$kodeAnggota, $data['jenis_anggota'], $data['nama'], $data['jenis_kelamin']]);

            $insertedDataCount++;
        }

        return response()->json([
            'jumlahData' => $insertedDataCount
        ]);
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
        $menu = 'anggota';

        $data = DB::table('anggota')->where('id', $id)->first();
        return view('anggota.edit', compact('menu', 'data'));
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
            'jenis_anggota' => 'required',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $data = DB::table('anggota')->where('id', $id)->first();
        if (!$data)
            redirect()->route('anggota.index')->with(['error' => 'data tidak ditemukan!']);

        $kodeAnggota = $data->kode_anggota;
        if ($data->jenis_anggota !== $request->jenis_anggota) {
            $kodeAnggota = $this->generateKodeAnggota($request->jenis_anggota, $id);
        }

        DB::update("UPDATE `anggota` SET `kode_anggota`=?, `jenis_anggota`=?, `nama`=?, `jenis_kelamin`=? WHERE id =?",
            [$kodeAnggota, $request->jenis_anggota, $request->nama, $request->jenis_kelamin, $id]);

        return redirect()->route('anggota.index')->with(['success' => 'data berhasil di update!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $anggota = DB::table('anggota')->where('id', $id)->first();
        if (!$anggota) {
            return redirect()->route('anggota.index')->with(['error' => 'data tidak ditemukan!']);
        }

        $jumlahPeminjaman = DB::table('peminjaman')->where('anggota_id', $id)->count();
        if ($jumlahPeminjaman > 0) {
            return redirect()->route('anggota.index')->with([
                'error' => 'Anggota ' . $anggota->kode_anggota . ' - ' . $anggota->nama . ' tidak dapat dihapus karena sudah memiliki riwayat peminjaman.'
            ]);
        }

        DB::table('anggota')->where('id', $id)->delete();
        // //redirect to index
        return redirect()->route('anggota.index')->with(['success' => ' data berhasil dihapus']);
    }

    private function generateKodeAnggota($jenisAnggota, $excludeId = null)
    {
        $prefixMap = [
            'Siswa' => 'S',
            'Guru'  => 'G',
            'Umum'  => 'U',
        ];

        $prefix = $prefixMap[$jenisAnggota] ?? 'A';
        $query = DB::table('anggota')
            ->where('jenis_anggota', $jenisAnggota)
            ->where('kode_anggota', 'like', $prefix . '-%');

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        $maxNumber = 0;
        foreach ($query->pluck('kode_anggota') as $code) {
            if (preg_match('/^' . preg_quote($prefix, '/') . '-(\d+)$/', $code, $matches)) {
                $maxNumber = max($maxNumber, (int) $matches[1]);
            }
        }

        return $prefix . '-' . str_pad($maxNumber + 1, 3, '0', STR_PAD_LEFT);
    }
}
