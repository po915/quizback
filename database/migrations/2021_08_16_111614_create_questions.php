<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->enum('type', ['option', 'tf']);
            $table->string('category');
            $table->text('answer_a')->nullable();
            $table->text('answer_b')->nullable();
            $table->text('answer_c')->nullable();
            $table->text('answer_d')->nullable();
            $table->enum('correct', ['a', 'b', 'c', 'd', 'true', 'false']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
