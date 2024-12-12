<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemakaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('pemakaian')->insert([
            [
                'user_id' => 1,
                'nama_pemakai' => 'Andi',
                'divisi' => 'HRD',
                'tanggal' => '2024-12-10',
                'jam_pemakaian' => '10:00:00',
                'barang_id' => 1,
                'jumlah_pemakaian' => 2,
                'alasan_pemakaian' => 'Luka kecil',
                'kotak_p3k_id' => 1 , 'created_at' => now(), 'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'nama_pemakai' => 'Budi',
                'divisi' => 'Produksi',
                'tanggal' => '2024-12-11',
                'jam_pemakaian' => '14:30:00',
                'barang_id' => 2,
                'jumlah_pemakaian' => 1,
                'alasan_pemakaian' => 'Tergores mesin',
                'kotak_p3k_id' => 2, 'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
