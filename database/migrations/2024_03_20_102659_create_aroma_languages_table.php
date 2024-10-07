<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aroma_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aroma_id')->constrained('aromas')->onDelete('cascade');
            $table->foreignId('language_id')->constrained('languages')->onDelete('cascade');
            $table->string('name');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('aroma_languages');
    }
};
