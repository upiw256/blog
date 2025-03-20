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
        Schema::create('subject_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_graduation');
            $table->unsignedBigInteger('kode_subject');
            $table->integer('value'); // Grade column for subject grades
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_graduation')->references('id')->on('graduations')->onDelete('cascade');
            $table->foreign('kode_subject')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_grades');
    }
};
