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
        Schema::create('input_kondisi', function (Blueprint $table) {
            $table->id('input_kondisi_id');
            $table->unsignedBigInteger('checklist_id');
 
            $table->foreign('checklist_id')->references('checklist_id')->on('checklist');
            $table->unsignedBigInteger('kondisi_id');
 
            $table->foreign('kondisi_id')->references('kondisi_id')->on('kondisi');
            
            $table->enum('status', ['tidak_sesuai', 'sesuai'])->default('tidak_sesuai');
            $table->text('tindakan_perbaikan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_kondisi');
    }
};
