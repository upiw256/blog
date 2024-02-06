<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->id();
            $table->uuid('rombongan_belajar_id')->unique();
            $table->string('nama');
            $table->integer('tingkat_pendidikan_id');
            $table->string('tingkat_pendidikan_id_str');
            $table->string('jenis_rombel_str');
            $table->string('kurikulum_id_str');
            $table->string('id_ruang_str');
            $table->string('moving_class');
            $table->string('ptk_id_str');
            $table->string('jurusan_id_str');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_rooms');
    }
};
