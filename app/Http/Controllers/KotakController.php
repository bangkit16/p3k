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
        dd($request->all());
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
