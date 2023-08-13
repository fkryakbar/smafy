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
        Schema::create('collection_package', function (Blueprint $table) {
            $table->id();
            $table->string('collection_slug');
            $table->string('package_slug');

            $table->foreign('collection_slug')->references('slug')->on('collection');
            $table->foreign('package_slug')->references('slug')->on('package');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_package');
    }
};
