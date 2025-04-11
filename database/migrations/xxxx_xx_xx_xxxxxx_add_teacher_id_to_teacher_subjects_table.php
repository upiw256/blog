<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherIdToTeacherSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teacher_subjects', function (Blueprint $table) {
            if (!Schema::hasColumn('teacher_subjects', 'teacher_id')) {
                $table->unsignedBigInteger('teacher_id')->nullable()->after('ptk_id'); // Add teacher_id column
                $table->foreign('teacher_id')->references('id')->on('teachers')->cascadeOnDelete(); // Add foreign key constraint
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teacher_subjects', function (Blueprint $table) {
            if (Schema::hasColumn('teacher_subjects', 'teacher_id')) {
                $table->dropForeign(['teacher_id']); // Drop foreign key constraint
                $table->dropColumn('teacher_id'); // Remove teacher_id column
            }
        });
    }
}
