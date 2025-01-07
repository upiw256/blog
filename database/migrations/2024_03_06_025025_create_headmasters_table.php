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
        Schema::create('headmasters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained("teachers")->cascadeOnDelete();
            $table->text("performance");
            $table->string("front_title")->nullable();
            $table->string("back_title")->nullable();
            $table->string("image");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headmasters');
    }
};
