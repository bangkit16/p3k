<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemakaian', function (Blueprint $table) {
            $table->id('pemakaian_id');
            $table->unsignedBigInteger('user_id');
            // $table->foreignId('user_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nama_pemakai');
            $table->string('divisi');
            $table->date('tanggal');
            $table->time('jam_pemakaian');
            
            $table->unsignedBigInteger('barang_id');
 
            $table->foreign('barang_id')->references('barang_id')->on('barang');$table->integer('jumlah_pemakaian');
            $table->text('alasan_pemakaian')->nullable();
            $table->unsignedBigInteger('kotak_p3k_id');
            $table->foreign('kotak_p3k_id')->references('kotak_p3k_id')->on('kotak_p3k');
            // $table->foreign('p3k_id')->references('p3k_id')->on('p3k');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaian');
    }
};
