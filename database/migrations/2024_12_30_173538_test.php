<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('search_movies', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Movie title
            $table->text('overview')->nullable(); // Movie overview/description
            $table->string('poster_path')->nullable(); // Path to the movie poster
            $table->date('release_date')->nullable(); // Release date of the movie
            $table->float('vote_average')->nullable(); // Average rating of the movie
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_movies');
    }
};
