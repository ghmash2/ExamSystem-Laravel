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
        Schema::table('answer_options', function (Blueprint $table) {

            $table->unsignedBigInteger('answer_id')->nullable()->change();
            $table->unsignedBigInteger('question_id')->nullable()->change();
            $table->tinyInteger('status')->nullable()->change();
            $table->unsignedBigInteger('solution')->nullable()->change();    //actual answer

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
