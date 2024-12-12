<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('input_checklist')->insert([
            [
                'barang_id' => 1,
                'checklist_id' => 1,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Masih sesuai dengan standar',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 2,
                'checklist_id' => 1,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Kondisi baik',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 3,
                'checklist_id' => 1,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Tidak ada kerusakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 4,
                'checklist_id' => 1,
                'jumlah_aktual' => 2,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Kondisi baru digunakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 5,
                'checklist_id' => 1,
                'jumlah_aktual' => 3,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Sesuai standar, cukup',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 6,
                'checklist_id' => 1,
                'jumlah_aktual' => 2,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Dapat digunakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 7,
                'checklist_id' => 1,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Kondisi normal',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 8,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Sesuai kebutuhan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 9,
                'checklist_id' => 1,
                'jumlah_aktual' => 12,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24)->toDateString(),
                'keterangan' => 'Tersedia dalam jumlah cukup',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 10,
                'checklist_id' => 1,
                'jumlah_aktual' => 3,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Tidak ada kendala',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 11,
                'checklist_id' => 1,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Digunakan untuk keamanan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 12,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(18)->toDateString(),
                'keterangan' => 'Siap pakai',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 13,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Kondisi bagus',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 14,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Normal',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 15,
                'checklist_id' => 1,
                'jumlah_aktual' => 2,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24)->toDateString(),
                'keterangan' => 'Stok aman',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 16,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24)->toDateString(),
                'keterangan' => 'Siap digunakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 17,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(18)->toDateString(),
                'keterangan' => 'Baik',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 18,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(18)->toDateString(),
                'keterangan' => 'Sesuai aturan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 19,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(18)->toDateString(),
                'keterangan' => 'Belum pernah digunakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 20,
                'checklist_id' => 1,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24)->toDateString(),
                'keterangan' => 'Masih dalam keadaan baru',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
        DB::table('input_checklist')->insert([
            [
                'barang_id' => 1,
                'checklist_id' => 2,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Masih sesuai dengan standar',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 2,
                'checklist_id' => 2,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Kondisi baik',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 3,
                'checklist_id' => 2,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Tidak ada kerusakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 4,
                'checklist_id' => 2,
                'jumlah_aktual' => 2,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Kondisi baru digunakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 5,
                'checklist_id' => 2,
                'jumlah_aktual' => 3,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Sesuai standar, cukup',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 6,
                'checklist_id' => 2,
                'jumlah_aktual' => 2,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Dapat digunakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 7,
                'checklist_id' => 2,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Kondisi normal',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 8,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Sesuai kebutuhan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 9,
                'checklist_id' => 2,
                'jumlah_aktual' => 12,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24)->toDateString(),
                'keterangan' => 'Tersedia dalam jumlah cukup',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 10,
                'checklist_id' => 2,
                'jumlah_aktual' => 3,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Tidak ada kendala',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 11,
                'checklist_id' => 2,
                'jumlah_aktual' => 4,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(6)->toDateString(),
                'keterangan' => 'Digunakan untuk keamanan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 12,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(18)->toDateString(),
                'keterangan' => 'Siap pakai',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 13,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Kondisi bagus',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 14,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(12)->toDateString(),
                'keterangan' => 'Normal',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 15,
                'checklist_id' => 2,
                'jumlah_aktual' => 2,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24)->toDateString(),
                'keterangan' => 'Stok aman',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 16,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24)->toDateString(),
                'keterangan' => 'Siap digunakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 17,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(18)->toDateString(),
                'keterangan' => 'Baik',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 18,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(18)->toDateString(),
                'keterangan' => 'Sesuai aturan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 19,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(18)->toDateString(),
                'keterangan' => 'Belum pernah digunakan',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'barang_id' => 20,
                'checklist_id' => 2,
                'jumlah_aktual' => 1,
                'tanggal_kadaluwarsa' => Carbon::now()->addMonths(24)->toDateString(),
                'keterangan' => 'Masih dalam keadaan baru',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
