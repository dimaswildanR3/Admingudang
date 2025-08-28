<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('surat_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cabang_id'); // pengaju dari cabang
            $table->unsignedBigInteger('barang_id'); // barang yang diajukan
            $table->integer('jumlah');
            $table->enum('status', ['dalam_proses', 'checking', 'preparing', 'dikirim'])->default('dalam_proses');
            $table->timestamps();

            $table->foreign('cabang_id')->references('id')->on('perusahaan')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('surat_pengajuan');
    }
};
