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
        Schema::create('answer_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('answer_id');
            $table->unsignedBigInteger('question_id');
            $table->tinyInteger('status');
            $table->unsignedBigInteger('solution');    //actual answer
            $table->unsignedBigInteger('answer_at')->nullable();  //user answer
            $table->timestamps();

            $table->foreign('answer_id')->references('id')->on('user_answers');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('solution')->references('id')->on('options');
            $table->foreign('answer_at')->references('id')->on('options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_options');
    }
};
