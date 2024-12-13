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
            ['barang_nama' => 'Kasa steril (isi 10)', 'tipe' => 'number', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Perban (lebar 5 cm) isi 10', 'tipe' => 'number', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Perban (lebar 10 cm) isi 5', 'tipe' => 'number', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Plester (lebar 1,25 cm)', 'tipe' => 'number', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Plester cepat sachet', 'tipe' => 'number', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Kapas (25 gram)', 'tipe' => 'number', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Kain segitiga (Mitela)', 'tipe' => 'number', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Gunting','tipe' => 'select', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Peniti','tipe' => 'select', 'jumlah_standar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Sarung tangan sekali pakai', 'tipe' => 'number', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Masker','tipe' => 'select', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Pinset', 'tipe' => 'number', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Lampu senter', 'tipe' => 'number', 'jumlah_standar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Gelas cuci mata', 'tipe' => 'number', 'jumlah_standar' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Kantong plastik','tipe' => 'select', 'jumlah_standar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Aquades', 'tipe' => 'number', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Povidon iodin', 'tipe' => 'number', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Alkohol', 'tipe' => 'number', 'jumlah_standar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Buku panduan P3K', 'tipe' => 'number', 'jumlah_standar' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['barang_nama' => 'Form pemakaian obat P3K', 'tipe' => 'number', 'jumlah_standar' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
        
    }
}
