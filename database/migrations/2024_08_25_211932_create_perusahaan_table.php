<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto_increment
            $table->string('perusahaan', 255); // nama perusahaan
            $table->text('alamat'); // alamat perusahaan
            $table->unsignedBigInteger('user_id'); // relasi ke user (pemilik / admin cabang)
            $table->timestamps();

            // foreign key ke users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('perusahaan');
    }
};
