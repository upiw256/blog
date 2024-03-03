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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('days');
            $table->integer('time');
            $table->integer('subject_id')->constrained("subjects")->cascadeOnDelete();
            $table->integer('class_id')->constrained("class_rooms")->cascadeOnDelete();
            $table->integer('teacher_id')->constrained("teachers")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
