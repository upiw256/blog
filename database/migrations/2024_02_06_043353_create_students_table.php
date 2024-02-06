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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('peserta_didik_id')->nullable();
            $table->string('nipd')->nullable();
            $table->string('sekolah_asal')->nullable();
            $table->string('nama');
            $table->string('nisn')->nullable();
            $table->char('jenis_kelamin', 1)->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama_id_str')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->string('nomor_telepon_seluler')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('pekerjaan_ayah_id_str')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('pekerjaan_ibu_id_str');
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali_id_str')->nullable();
            $table->string('anak_keberapa')->nullable();
            $table->string('nama_rombel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
