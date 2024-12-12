<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KondisiInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('input_kondisi')->insert([
            ['checklist_id' => 1, 'kondisi_id' => 1, 'status' => 'sesuai', 'tindakan_perbaikan' => 'Cat warna putih' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 1, 'kondisi_id' => 2, 'status' => 'sesuai', 'tindakan_perbaikan' => 'buat lebih menarik' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 1, 'kondisi_id' => 3, 'status' => 'sesuai', 'tindakan_perbaikan' => 'ganti menjadi tas' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 1, 'kondisi_id' => 4, 'status' => 'tidak_sesuai', 'tindakan_perbaikan' => 'kurang obat' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 1, 'kondisi_id' => 5, 'status' => 'sesuai', 'tindakan_perbaikan' => 'Tambah stok baru' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 2, 'kondisi_id' => 1, 'status' => 'sesuai', 'tindakan_perbaikan' => 'Cat warna putih' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 2, 'kondisi_id' => 2, 'status' => 'sesuai', 'tindakan_perbaikan' => 'buat lebih menarik' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 2, 'kondisi_id' => 3, 'status' => 'sesuai', 'tindakan_perbaikan' => 'ganti menjadi tas' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 2, 'kondisi_id' => 4, 'status' => 'tidak_sesuai', 'tindakan_perbaikan' => 'kurang obat' , 'created_at' => now(), 'updated_at' => now()],
            ['checklist_id' => 2, 'kondisi_id' => 5, 'status' => 'sesuai', 'tindakan_perbaikan' => 'Tambah stok baru' , 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
