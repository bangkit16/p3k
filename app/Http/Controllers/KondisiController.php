<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use Illuminate\Http\Request;

class KondisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $limit = $request->input('limit', 10);  // Default pagination limit
        $search = $request->search;

        // Sorting
        $sortBy = $request->get('sort_by', 'kondisi_id');  // Default sorting column (ganti dengan kolom yang ada di tabel uraian)
        $order = $request->get('order', 'asc');   // Default sorting order ('asc' atau 'desc')

        // Query dasar
        $data = Kondisi::query();

        // Filter pencarian
        if ($search) {
            $data->where('kondisi_nama', 'like', "%{$search}%");
        }

        // Terapkan sorting
        $data->orderBy($sortBy, $order);

        // Pagination atau semua data
        if ($limit == 'all') {
            $data = $data->get();  // Ambil semua data
        } else {
            $data = $data->paginate($limit)->appends($request->only('search', 'limit', 'sort_by', 'order')); // Tambahkan query params
        }

        // Kirim data ke view
        return view('admin.kondisi.index', compact('data', 'sortBy', 'order'));
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

        $validated = $request->validate([
            'kondisi_nama' => 'required',
        ],[
            'kondisi_nama.required' => 'Nama Kondisi harus diisi',
            
        ]);
        // dd($);
        // dd($validated);
        Kondisi::create($validated);

        return redirect()->route('kondisi.index')->withStatus('Kondisi berhasil ditambahkan.');
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
        $kondisi = Kondisi::find($id);

        $validated = $request->validate([
            'edit_kondisi_nama' => 'required',
        ],[
            'edit_kondisi_nama.required' => 'Nama kondisi harus diisi',
            
        ]);

        // dd($validated);
        $kondisi->update([
            'kondisi_nama' => $validated['edit_kondisi_nama'],
        ]);

        return redirect()->route('kondisi.index')->withStatus('Kondisi berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $kondisi = Kondisi::find($id);
        $kondisi->delete();
        return redirect()->route('kondisi.index')->withStatus('Barang berhasil dihapus.');
    }
}
