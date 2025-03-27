<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempTeacherSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('temp_teacher_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ptk_id');
            $table->unsignedBigInteger('subject_id');
            $table->timestamps();

            // Add indexes for faster lookups
            $table->index(['ptk_id', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_teacher_subjects');
    }
}
