<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
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
        $sortBy = $request->get('sort_by', 'barang_id');  // Default sorting column (ganti dengan kolom yang ada di tabel uraian)
        $order = $request->get('order', 'asc');   // Default sorting order ('asc' atau 'desc')

        // Query dasar
        $data = Barang::query();

        // Filter pencarian
        if ($search) {
            $data->where('barang_nama', 'like', "%{$search}%")
            ->orWhere('jumlah_standar', 'like', "%{$search}%")
            ->orWhere('tipe', 'like', "%{$search}%");
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
        return view('admin.barang.index', compact('data', 'sortBy', 'order'));
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
            'barang_nama' => 'required',
            'jumlah_standar' => 'required|numeric|gt:0',
            'tipe' => 'required',
        ],[
            'barang_nama.required' => 'Nama Barang harus diisi',
            'jumlah_standar.required' => 'Jumlah Standar harus diisi',
            'jumlah_standar.numeric' => 'Jumlah Standar harus berupa angka',
            'jumlah_standar.lt' => 'Jumlah Standar tidak boleh lebih besar dari 0',
            'tipe.required' => 'Tipe harus diisi',
            
        ]);
        // dd($);
        // dd($validated);
        Barang::create($validated);

        return redirect()->route('barang.index')->withStatus('Barang berhasil ditambahkan.');
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
// dd($request->all());

        $barang = Barang::find($id);

        $validated = $request->validate([
            'edit_barang_nama' => 'required',
            'edit_tipe' => 'required',
            'edit_jumlah_standar' => 'required|numeric|gt:0',
        ],[
            'edit_barang_nama.required' => 'Nama Barang harus diisi',
            'edit_tipe.required' => 'Tipe harus diisi',
            'edit_jumlah_standar.required' => 'Jumlah Standar harus diisi',
            'edit_jumlah_standar.numeric' => 'Jumlah Standar harus berupa angka',
            'edit_jumlah_standar.lt' => 'Jumlah Standar tidak boleh lebih besar dari 0',
            
        ]);

        // dd($validated);
        $barang->update([
            'barang_nama' => $validated['edit_barang_nama'],
            'jumlah_standar' => $validated['edit_jumlah_standar'],
            'tipe' => $validated['edit_tipe'],
        ]);

        return redirect()->route('barang.index')->withStatus('Barang berhasil diperbaharui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $barang = Barang::find($id);
        $barang->delete();
        return redirect()->route('barang.index')->withStatus('Barang berhasil dihapus.');
    }
}
