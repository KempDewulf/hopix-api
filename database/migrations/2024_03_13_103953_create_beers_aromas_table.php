<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beers_aromas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beer_id')->constrained('beers')->onDelete('cascade');
            $table->foreignId('aroma_id')->constrained('aromas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beers_aromas');
    }
};
