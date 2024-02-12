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
        Schema::create('member_extras', function (Blueprint $table) {
            $table->id();

            $table->foreignId('extracurricular_activity_id')->constrained("extracurricular_activities")->cascadeOnDelete();

            $table->foreignId('student_id')->constrained("students")->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_extras');
    }
};
