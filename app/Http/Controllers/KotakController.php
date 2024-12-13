<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KotakP3K;
use App\Models\P3K;
use Illuminate\Http\Request;

class KotakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    
    public function index(Request $request)
    {
        // dd(KotakP3K::with('p3ks')->get()->toArray());
        //
        $data = P3K::with([ 'barang' , 'kotakP3k' ])->get()->groupBy('kotakP3k.lokasi');

        // dd($data->toArray());
        $barang = Barang::all();
        // foreach ($data as $key => $value) {
        //     dump($value);
        // }
        // dd($data->toArray());
        
        // Kirim data ke view
        return view('admin.kotakp3k.index', compact('data' , 'barang'));
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
        //

        // dd($request->all());
        $validated = $request->validate([
            'lokasi' => 'required',
            'barang_id' => ['required', 'array', 'min:1'], // Barang harus array minimal 1
            'barang_id.*' => ['required', 'distinct'],    // Setiap elemen harus unik dan tidak boleh kosong
            'jumlah' => ['required', 'array', 'min:1'],   // Jumlah harus array minimal 1
            'jumlah.*' => ['required', 'min:1'], // Setiap jumlah harus angka positif minimal 1
        ], [
            'lokasi.required' => 'Lokasi harus diisi.',
            'barang_id.required' => 'Barang harus diisi.',
            'barang_id.min' => 'Minimal 1 barang harus dipilih.',
            'barang_id.*.distinct' => 'Tidak boleh ada barang yang sama.',
            'barang_id.*.required' => 'Setiap barang harus dipilih.',
            'jumlah.required' => 'Jumlah harus diisi.',
            'jumlah.*.required' => 'Jumlah setiap barang harus diisi.',
            'jumlah.*.integer' => 'Jumlah harus berupa angka.',
            'jumlah.*.min' => 'Jumlah minimal adalah 1.',
        ]);


        $id = KotakP3K::create([
            'lokasi' => $validated['lokasi'],
        ]);

        foreach ($validated['barang_id'] as $index => $barangId) {
            P3K::create([
                'kotak_p3k_id' => $id->kotak_p3k_id,
                'barang_id' => $barangId,
                'jumlah' => $validated['jumlah'][$index],
            ]);
        }
        
        // dd($validated);
        return redirect()->route('kotak.index')->withStatus('Kotak P3K berhasil ditambahkan.');
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
        // dd($request->all() , $id);
        $validate = $request->validate([
            'edit_lokasi' => 'required|string|max:255',
            'edit_barang_id' => 'required|array|min:1',
            'edit_barang_id.*' => 'required|exists:barang,barang_id', // Validasi bahwa ID barang ada di tabel barang
            'edit_jumlah' => 'required|array|min:1',
            'edit_jumlah.*' => 'required|integer|min:1', // Validasi bahwa edit_jumlah harus angka minimal 1
        ], [
            'edit_lokasi.required' => 'Lokasi kotak harus diisi.',
            'edit_barang_id.required' => 'Minimal 1 barang harus dipilih.',
            'edit_barang_id.*.required' => 'Barang harus dipilih.',
            'edit_barang_id.*.exists' => 'Barang tidak valid.',
            'edit_jumlah.required' => 'Jumlah barang harus diisi.',
            'edit_jumlah.*.required' => 'Jumlah barang harus diisi.',
            'edit_jumlah.*.integer' => 'Jumlah barang harus berupa angka.',
            'edit_jumlah.*.min' => 'Jumlah barang minimal 1.',
        ]); 

        KotakP3K::find($id)->update([
            'lokasi' => $validate['edit_lokasi'],
        ]);

        $p3kslama = P3K::where('kotak_p3k_id', $id);

        $p3kslama->delete();

        foreach ($validate['edit_barang_id'] as $index => $barangId) {
            P3K::create([
                'kotak_p3k_id' => $id,
                'barang_id' => $barangId,
                'jumlah' => $validate['edit_jumlah'][$index],
            ]);
        }

        // dd($p3ks);

        // $kotak = KotakP3K::find($id)->p3ks;

        foreach ($validate['edit_barang_id'] as $index => $barangId) {
            P3K::where('kotak_p3k_id', $id)->where('barang_id', $barangId)->update([
                'jumlah' => $validate['edit_jumlah'][$index],
            ]);
        }

        // dd($validate , $id);
        return redirect()->route('kotak.index')->withStatus('Kotak P3K berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
