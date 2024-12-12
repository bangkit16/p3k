<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Checklist;
use App\Models\InputChecklist;
use App\Models\Kondisi;
use App\Models\KondisiInput;
use App\Models\KotakP3K;
use App\Models\P3K;
use Illuminate\Http\Request;

class InspeksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $checklist = Checklist::with(['user' , 'inputChecklists.barang' , 'kondisiInputs.kondisi' , 'kotakP3k'])->where('user_id' , auth()->user()->id)->get()->toArray();
        $data = Checklist::with(['user'  , 'kotakP3k'])->where('user_id' , auth()->user()->id)->get();


        // dd($data);
        return view('admin.inspeksi.index' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $idkotak = $request->idkotak;

        $kotak = KotakP3K::all();
        $data = [];

        $barang = P3K::With('barang')->where('kotak_p3k_id', $idkotak)->get();

        $kondisi = Kondisi::all();

        // dd($barang->toArray());


        return view('admin.inspeksi.create' , compact('kotak' , 'barang' , 'kondisi' , 'idkotak'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah_aktual.*' => 'required|numeric|gt:0',
            'tanggal_kadaluarsa.*' => 'required|date',
            'keterangan.*' => 'nullable',
            'status.*' => 'required',
            'tindakan.*' => 'nullable',
        ],[
            'jumlah_aktual.*.required' => 'Jumlah aktual harus diisi',
            'jumlah_aktual.*.numeric' => 'Jumlah aktual harus berupa angka',
            'jumlah_aktual.*.lt' => 'Jumlah aktual tidak boleh lebih besar dari 0',
            'tanggal_kadaluarsa.*.required' => 'Field tanggal kadaluarsa harus diisi',
            'tanggal_kadaluarsa.*.date' => 'Tanggal kadaluarsa harus berupa tanggal',
            'keterangan.*' => 'Keterangan harus diisi',
            'status.*.required' => 'Status harus diisi',
            'tindakan.*' => 'Tindakan harus diisi',
        ]);


        // dd($validated);
        $id = Checklist::create([
            'tanggal' => now(),
            'user_id' => auth()->user()->id,
            'status' => 'belum_diseleksi',
            'kotak_p3k_id' => $request->idkotak,
        ]);

        


        foreach ($validated['jumlah_aktual'] as $key => $value) {
            InputChecklist::create([
                'barang_id' => $key,
                'checklist_id' => $id->checklist_id,
                'jumlah_aktual' => $value,
                'tanggal_kadaluwarsa' => $validated['tanggal_kadaluarsa'][$key],
                'keterangan' => $validated['keterangan'][$key],
            ]);
        }
        
        foreach ($validated['status'] as $key1 => $value1) {
            KondisiInput::create([
                'kondisi_id' => $key1,
                'checklist_id' => $id->checklist_id,
                'status' => $value1,
                'tindakan_perbaikan' => $validated['tindakan'][$key1],
            ]);
        }


        return redirect()->route('kotak.create')->withStatus('Checklist P3K berhasil ditambahkan.');
        
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Checklist::with(['user' , 'inputChecklists.barang' , 'kondisiInputs.kondisi' , 'kotakP3k'])->where('user_id' , auth()->user()->id)->where('checklist_id' , $id)->first();

        

        // dd($data->inputChecklists);
        return view('admin.inspeksi.show' , compact('data'));
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
