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
        Schema::table('exams', function (Blueprint $table) {
            $table->unsignedBigInteger('is_specific_student')->nullable()->change();
            $table->integer('duration')->nullable()->change();
            $table->foreign('is_specific_student')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
             $table->dropForeign(['is_specific_student']);
             $table->tinyInteger('is_specific_student')->default(0)->change();
        });
    }
};
