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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('tagline')->nullable();
            $table->date('exam_date')->nullable();
            $table->time('exam_start_time')->nullable();
            $table->time('exam_end_time')->nullable();
            $table->string('instruction')->nullable();
            $table->integer('full_mark')->nullable();
            $table->time('duration')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->tinyInteger('exam_status')->nullable();
            $table->tinyInteger('can_view_result')->default(0);
            $table->tinyInteger('is_question_random')->default(0);
            $table->tinyInteger('is_option_random')->default(0);
            $table->string('exam_link')->unique()->nullable();
            $table->tinyInteger('is_signin_required')->default(0);
            $table->tinyInteger('is_specific_student')->default(0);
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('exams');
    }
};
