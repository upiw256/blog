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
        Schema::table('temp_teacher_subjects', function (Blueprint $table) {

            $table->string('ptk_id')->change(); // Change ptk_id to string
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('temp_teacher_subjects', function (Blueprint $table) {

            $table->integer('ptk_id')->change(); // Revert ptk_id to integer if needed
    
        });
    }
};
