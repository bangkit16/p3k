<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Checklist;
use App\Models\InputChecklist;
use App\Models\Kondisi;
use App\Models\KondisiInput;
use App\Models\KotakP3K;
use App\Models\P3K;
use App\Models\User;
use Illuminate\Http\Request;
use Mail;

class InspeksiController extends Controller
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
         $data = Checklist::with(['user'  , 'kotakP3k']);

        if ($search) {
            $kotak = KotakP3K::where('lokasi', 'like', "%{$search}%")->pluck('kotak_p3k_id'); // Ambil ID User
            $data->where(function ($q) use ($search, $bulan, $kotak) {
                if ($kotak->isNotEmpty()) {
                    $q->orWhere('kotak_p3k_id', $kotak); // Asumsikan patrol memiliki `user_id`
                }
                if ($bulan) {
                    $q->orWhereMonth('tanggal', $bulan); // Cari berdasarkan bulan
                }
                $q->orWhere('tanggal', 'like', "%{$search}%");
            });
        }

        if(auth()->user()->role_id == 3){
            
            $data->where('user_id' , auth()->user()->id);
        }
        if(auth()->user()->role_id == 2 ){
            
            $data->orWhere('status' , 'Approve Admin')->orWhere('status' , 'Approve Manager')->orWhere('status' , 'Ditolak Manager');
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'checklist_id');  // Default sorting column (ganti dengan kolom yang ada di tabel Role)
        $order = $request->get('order', 'asc');   // Default sorting order ('asc' atau 'desc')
        // Terapkan sorting
        $data->orderBy($sortBy, $order);

        // Pagination atau semua data
        if ($limit == 'all') {
            $data = $data->get();  // Ambil semua data
        } else {
            $data = $data->paginate($limit)->appends($request->only('search', 'limit', 'sort_by', 'order')); // Tambahkan query params
        }
        // dd($data);
        return view('admin.inspeksi.index' , compact('data', 'sortBy', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if(auth()->user()->role_id == 2){
            return redirect()->route('inspeksi.index')->withStatus('Anda tidak memiliki akses ke halaman ini.');
        }
        //
        $idkotak = $request->idkotak;

        $kotak = KotakP3K::all();
        $data = [];

        $barang = P3K::With('barang')->where('kotak_p3k_id', $idkotak)->get();

        $kondisi = Kondisi::all();

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

        // Kirim Notifikasi Email
        $details = [
            'user' => auth()->user()->name,
            'tanggal' => now()->toDateTimeString(),
        ];

        $user = User::all();
        
        foreach ($user as $us) {
            if ($us->role_id == 1) {
                Mail::to($us->email)->send(new \App\Mail\NotifyEmail1($details));
            }
        }


        return redirect()->route('inspeksi.index')->withStatus('Checklist P3K berhasil ditambahkan.');
        
        
    }
    public function approve($id){
        $checklist = Checklist::find($id);
        if (auth()->user()->role_id == 1) {
            # code...
            $checklist->status = 'Approve Admin';

            // Kirim Notifikasi Email
            $details = [
                'tanggal' => now()->toDateTimeString(),
            ];

            $user = User::all();
            
            foreach ($user as $us) {
                if ($us->role_id == 2) {
                    Mail::to($us->email)->send(new \App\Mail\NotifyEmail2($details));
                }
            }
        }
        else if (auth()->user()->role_id == 2) {
            # code...
            $checklist->status = 'Approve Manager';

            // Kirim Notifikasi Email
            $details = [
                'tanggal' => now()->toDateTimeString(),
            ];

            $user = User::all();
            
            foreach ($user as $us) {
                if ($us->user_id == $checklist->user_id) {
                    Mail::to($us->email)->send(new \App\Mail\NotifyEmail3($details));
                }
            }
        }
        $checklist->save();
        return redirect()->route('inspeksi.index')->withStatus('Checklist P3K berhasil disetujui.');
    }
    public function tolak($id){
        $checklist = Checklist::find($id);
        if (auth()->user()->role_id == 1) {
            # code...
            $checklist->status = 'Ditolak Admin';
            // Kirim Notifikasi Email
            $details = [
                'tanggal' => now()->toDateTimeString(),
            ];

            $user = User::all();
            
            foreach ($user as $us) {
                if ($us->user_id == $checklist->user_id) {
                    Mail::to($us->email)->send(new \App\Mail\NotifyEmail4($details));
                }
            }
        }
        else if (auth()->user()->role_id == 2) {
            # code...
            $checklist->status = 'Ditolak Manager';

            // Kirim Notifikasi Email
            $details = [
                'tanggal' => now()->toDateTimeString(),
            ];

            $user = User::all();
            
            foreach ($user as $us) {
                if ($us->user_id == $checklist->user_id) {
                    Mail::to($us->email)->send(new \App\Mail\NotifyEmail4($details));
                }
            }
        }
        $checklist->save();
        return redirect()->route('inspeksi.index')->withStatus('Checklist P3K berhasil ditolak.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Checklist::with(['user' , 'inputChecklists.barang' , 'kondisiInputs.kondisi' , 'kotakP3k'])->where('checklist_id' , $id)->first();
        
        $id = $id;
        

        // dd($data->inputChecklists);
        return view('admin.inspeksi.show' , compact('data' , 'id'));
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
