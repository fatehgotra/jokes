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
        Schema::create('guess_the_voice', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->string('ques_time_limit');
            $table->string('game_question_limit');
            $table->integer('lifeline');
            $table->longText('rules');
            $table->integer('qualified_score');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guess_the_voice');
    }
};
