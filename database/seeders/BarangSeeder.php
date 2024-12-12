<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('barang')->insert([  
            ['barang_nama' => 'Kasa steril (isi 10)', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Perban (lebar 5 cm) isi 10', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Perban (lebar 10 cm) isi 5', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Plester (lebar 1,25 cm)', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Plester cepat sachet', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Kapas (25 gram)', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Kain segitiga (Mitela)', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Gunting', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Peniti', 'jumlah_standar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Sarung tangan sekali pakai', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Masker', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Pinset', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Lampu senter', 'jumlah_standar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Gelas cuci mata', 'jumlah_standar' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Kantong plastik', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Aquades', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Povidon iodin', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Alkohol', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Buku panduan P3K', 'jumlah_standar' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Form pemakaian obat P3K', 'jumlah_standar' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
