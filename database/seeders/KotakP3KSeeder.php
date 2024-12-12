<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KotakP3KSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('kotak_p3k')->insert([
            [ 'lokasi' => 'Kantor' , 'created_at' => now(), 'updated_at' => now()],
            [ 'lokasi' => 'Dapur' , 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
