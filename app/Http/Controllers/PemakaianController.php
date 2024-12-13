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
    public function index(Request $request)
    {
        $limit = $request->input('limit', 10);  // Default pagination limit
        $search = $request->search;

        $bulanMap = [
            'januari' => '01', 'februari' => '02', 'maret' => '03',
            'april' => '04', 'mei' => '05', 'juni' => '06',
            'juli' => '07', 'agustus' => '08', 'september' => '09',
            'oktober' => '10', 'november' => '11', 'desember' => '12',
        ];

        $bulan = null;
        if ($search) {
            $searchLower = strtolower($search);
            if (isset($bulanMap[$searchLower])) {
                $bulan = $bulanMap[$searchLower];
            }
        }

         // Query dasar
        $data = Pemakaian::with(['kotakP3k' , 'barang' , 'user']);

        if ($search) {
            $barang = Barang::where('barang_nama', 'like', "%{$search}%")->pluck('barang_id');
            $kotak = KotakP3K::where('lokasi', 'like', "%{$search}%")->pluck('kotak_p3k_id'); // Ambil ID User
            $data->where(function ($q) use ($search, $bulan, $barang, $kotak) {
                if ($barang->isNotEmpty()) {
                    $q->orWhereIn('barang_id', $barang);
                }
                if ($kotak->isNotEmpty()) {
                    $q->orWhere('kotak_p3k_id', $kotak); // Asumsikan patrol memiliki `user_id`
                }
                if ($bulan) {
                    $q->orWhereMonth('tanggal', $bulan); // Cari berdasarkan bulan
                }
                $q->orWhere('tanggal', 'like', "%{$search}%")
                ->orWhere('nama_pemakai', 'like', "%{$search}%")
                ->orWhere('divisi', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'pemakaian_id');  // Default sorting column (ganti dengan kolom yang ada di tabel Role)
        $order = $request->get('order', 'asc');   // Default sorting order ('asc' atau 'desc')
        // Terapkan sorting
        $data->orderBy($sortBy, $order);

        // Pagination atau semua data
        if ($limit == 'all') {
            $data = $data->get();  // Ambil semua data
        } else {
            $data = $data->paginate($limit)->appends($request->only('search', 'limit', 'sort_by', 'order')); // Tambahkan query params
        }
        // $data = Pemakaian::with(['kotakP3k' , 'barang' , 'user'])->get();
        // dd($data->toArray() , $data);
        $barang = Barang::all();
        $kotak = KotakP3K::all();

        return view('admin.pemakaian.index' , compact('data' , 'barang' , 'kotak', 'sortBy', 'order'));
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
