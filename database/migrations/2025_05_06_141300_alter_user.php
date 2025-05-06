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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_teacher')->nullable()->after('id'); // Tambahkan kolom id_teacher
            $table->foreign('id_teacher')->references('id')->on('teachers')->onDelete('set null'); // Relasi ke tabel teachers
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_teacher']); // Hapus foreign key
            $table->dropColumn('id_teacher'); // Hapus kolom id_teacher
        });
    }
};
