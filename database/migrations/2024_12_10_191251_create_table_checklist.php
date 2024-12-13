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
        Schema::create('checklist', function (Blueprint $table) {
            $table->id('checklist_id');
            $table->date('tanggal');
            $table->enum('status', ['Belum Approve', 'Approve Admin' , 'Approve Manager',  'Ditolak Admin' , 'Ditolak Manager'])->default('Belum Approve');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kotak_p3k_id');
            // $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
            
            $table->foreign('kotak_p3k_id')->references('kotak_p3k_id')->on('kotak_p3k');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist');
    }
};
