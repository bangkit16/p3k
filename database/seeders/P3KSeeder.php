<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class P3KSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('p3k')->insert([
            ['kotak_p3k_id' => 1, 'barang_id' => 1, 'jumlah' => 5 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 2, 'jumlah' => 5 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 3, 'jumlah' => 5 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 15, 'jumlah' => 5 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 10, 'jumlah' => 5 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 4, 'jumlah' => 5 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 5, 'jumlah' => 5 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 8, 'jumlah' => 'hampir habis' , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 9, 'jumlah' => 'hampir habis' , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 1, 'barang_id' => 7, 'jumlah' => 5 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 1, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 2, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 3, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 4, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 5, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 6, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 7, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 8, 'jumlah' => 'hampir habis' , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 9, 'jumlah' => 'hampir habis' , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 10, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 11, 'jumlah' => 'hampir habis' , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 12, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 12, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 13, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 14, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 15, 'jumlah' => 'hampir habis' , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 17, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 18, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 19, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],
            ['kotak_p3k_id' => 2, 'barang_id' => 20, 'jumlah' => 3 , 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
