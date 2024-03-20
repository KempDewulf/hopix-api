<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->id();
            $table->float('abv');
            $table->integer('drinking_temp');
            $table->integer('ibu');
            $table->foreignId('brewery_id')->constrained('breweries')->onDelete('cascade');
            $table->integer('amount_of_ratings')->default(0);
            $table->double('sum_ratings')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beers');
    }
};
