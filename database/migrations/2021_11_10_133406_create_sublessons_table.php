<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sublessons', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('lesson_slug');
            $table->foreign('lesson_slug')->references('slug')->on('lessons')->onDelete('cascade');
            $table->string('user_id');
            $table->string('title');
            $table->string('sublesson_type');
            $table->integer('timer');
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
        Schema::dropIfExists('sublessons');
    }
};
