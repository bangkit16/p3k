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
        Schema::create('p3k', function (Blueprint $table) {
            $table->id('p3k_id');
            // $table->string('lokasi');
            $table->unsignedBigInteger('barang_id');
 
            $table->foreign('barang_id')->references('barang_id')->on('barang');
            $table->unsignedBigInteger('kotak_p3k_id');
 
            $table->foreign('kotak_p3k_id')->references('kotak_p3k_id')->on('kotak_p3k');
            // $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p3k');
    }
};
