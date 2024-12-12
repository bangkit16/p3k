<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KondisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('kondisi')->insert([
            ['kondisi_nama' => 'Kotak P3K berwarna dasar putih dengan tanda cross berwarna hijau' , 'created_at' => now(), 'updated_at' => now()],           ['kondisi_nama' => 'Kotak P3K dalam kondisi dapat dilihat oleh banyak orang/ tidak tertutup/ terhalangi oleh benda lain' , 'created_at' => now(), 'updated_at' => now()],
            ['kondisi_nama' => 'Kotak P3K dapat dibawa kemana-mana' , 'created_at' => now(), 'updated_at' => now()],
            ['kondisi_nama' => 'Form Pemakaian Obat P3K ada didekat kotak P3K' , 'created_at' => now(), 'updated_at' => now()],
            ['kondisi_nama' => 'Tidak terdapat obat minum dalam kotak obat P3K' , 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
