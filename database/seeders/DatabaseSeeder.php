<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([
            BarangSeeder::class,
            KotakP3KSeeder::class,
            P3KSeeder::class,

            KondisiSeeder::class,
            ChecklistSeeder::class,
            InputChecklistSeeder::class,
            KondisiInputSeeder::class,
            PemakaianSeeder::class,
        ]);
    }
}
