<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->string('judul');
            $table->text('isi');
            $table->enum('jenis', ['masuk', 'keluar']); // tipe surat
            $table->string('pengirim')->nullable(); // untuk surat masuk
            $table->string('penerima')->nullable(); // untuk surat keluar
            $table->date('tanggal_surat');
            $table->string('file_surat')->nullable(); // upload file pdf/doc
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surats');
    }
};
