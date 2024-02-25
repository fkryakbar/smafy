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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('sublesson_slug');
            $table->foreign('sublesson_slug')->references('slug')->on('sublessons')->onDelete('cascade');
            $table->string('type');
            $table->string('title');
            $table->string('image_path')->nullable();
            $table->longText('content');
            $table->json('format');
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
        Schema::dropIfExists('slides');
    }
};
