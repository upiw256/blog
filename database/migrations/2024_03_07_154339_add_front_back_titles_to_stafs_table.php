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
        Schema::table('stafs', function (Blueprint $table) {
            $table->string('front_title')->nullable()->before('created_at');
            $table->string('back_title')->nullable()->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stafs', function (Blueprint $table) {
            $table->dropColumn('front_title');
            $table->dropColumn('back_title');
        });
    }
};
