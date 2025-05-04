<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('graduations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->boolean('information')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduations');

        // Check if the unique constraint exists before dropping it
        $uniqueExists = DB::table('pg_indexes')
            ->where('tablename', 'students')
            ->where('indexname', 'students_peserta_didik_id_unique')
            ->exists();

        if ($uniqueExists) {
            Schema::table('students', function (Blueprint $table) {
                $table->dropUnique('students_peserta_didik_id_unique');
            });
        }
    }
};
