<?php

namespace Database\Seeders;

use App\Models\Checklist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //
        DB::table('checklist')->insert([
            'tanggal' => '2024-12-10',  'user_id' => 1 ,'kotak_p3k_id' => '1', 'created_at' => now(), 'updated_at' => now()
            
        ]);
        DB::table('checklist')->insert([
            'tanggal' => '2024-12-15',  'user_id' => 1 ,'kotak_p3k_id' => '2', 'created_at' => now(), 'updated_at' => now()
            
        ]);
        DB::table('checklist')->insert([
            'tanggal' => '2024-12-17',  'user_id' => 3 ,'kotak_p3k_id' => '1', 'created_at' => now(), 'updated_at' => now()
            
        ]);
        DB::table('checklist')->insert([
            'tanggal' => '2024-12-17',  'user_id' => 3 ,'kotak_p3k_id' => '2', 'created_at' => now(), 'updated_at' => now()
            
        ]);
        DB::table('checklist')->insert([
            'tanggal' => '2024-12-17',  'user_id' => 3 ,'kotak_p3k_id' => '1', 'created_at' => now(), 'updated_at' => now()
            
        ]);
        // Checklist::insert([
        //     ['tanggal' => '2024-12-11', 'user_id' => 1],
        // ]);
    }
}
