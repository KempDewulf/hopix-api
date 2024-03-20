<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beer_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beer_id')->constrained('beers')->onDelete('cascade');
            $table->foreignId('language_id')->constrained('languages')->onDelete('cascade');
            $table->string('name');
            $table->string('style');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beer_languages');
    }
};
