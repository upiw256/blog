<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUniqueConstraintFromPtkId extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teacher_subjects', function (Blueprint $table) {
            $table->dropUnique('teacher_subjects_ptk_id_unique'); // Drop the UNIQUE constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_subjects', function (Blueprint $table) {
            $table->unique('ptk_id'); // Re-add the UNIQUE constraint
        });
    }
}
