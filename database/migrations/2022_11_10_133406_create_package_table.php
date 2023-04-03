<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('user_id');
            $table->string('title');
            $table->string('description');
            $table->string('topic_type');
            $table->string('show_correction_lesson');
            $table->string('show_correction_quiz');
            $table->integer('timer');
            $table->string('show_result');
            $table->string('show_public');
            $table->string('accept_responses');
            $table->boolean('is_duplicated')->default(false);
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
        Schema::dropIfExists('package');
    }
}
