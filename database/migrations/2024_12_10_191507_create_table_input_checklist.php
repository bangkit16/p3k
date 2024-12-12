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
        Schema::create('input_checklist', function (Blueprint $table) {
            $table->id('input_checklist_id');
            
            $table->unsignedBigInteger('barang_id');
 
            $table->foreign('barang_id')->references('barang_id')->on('barang');
            
            $table->unsignedBigInteger('checklist_id');
 
            $table->foreign('checklist_id')->references('checklist_id')->on('checklist');
            // $table->foreignId('checklist_id')->constrained('tabel_checklist')->onDelete('cascade');
            $table->integer('jumlah_aktual');
            $table->date('tanggal_kadaluwarsa')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_checklist');
    }
};
