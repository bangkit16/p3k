<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KotakP3K;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Pemakaian::with(['kotakP3k' , 'barang' , 'user'])->get();
        // dd($data->toArray() , $data);
        $barang = Barang::all();
        $kotak = KotakP3K::all();

        return view('admin.pemakaian.index' , compact('data' , 'barang' , 'kotak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //'
        $validated = $request->validate([
            'nama_pemakai' => 'required',
            'divisi' => 'required',
            // 'jumlah_pemakian' => 'required',
            'tanggal' => 'required|date',
            'barang_id' => 'required',
            'kotak_p3k_id' => 'required',
            'jam_pemakaian' => 'required',
            'jumlah_pemakaian' => 'required|numeric',
            'alasan_pemakaian' => 'required',
        ] , [
            'kotak_p3k_id.required' => 'Kotak P3K harus dipilih',
            'barang_id.required' => 'Barang harus dipilih',
            'jumlah_pemakaian.required' => 'Jumlah pemakaian harus diisi',
            'jumlah_pemakaian.numeric' => 'Jumlah pemakaian harus berupa angka',
            'alasan_pemakaian.required' => 'Alasan pemakaian harus diisi',
            'jam_pemakaian.required' => 'Jam pemakaian harus diisi',
            'tanggal.required' => 'Tanggal pemakaian harus diisi',
            'tanggal.date' => 'Format tanggal pemakaian harus YYYY-MM-DD',
            'nama_pemakai.required' => 'Nama pemakai harus diisi',
            'divisi.required' => 'Divisi pemakai harus diisi',

        ]);

        $validated['user_id'] = auth()->user()->id;

        Pemakaian::create($validated);

        return redirect()->route('pemakaian.index')->withStatus('Pemakaian berhasil ditambahkan.');
        // dd($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
