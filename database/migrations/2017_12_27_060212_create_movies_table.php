<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 70);
            $table->integer('score')->nullable();
            $table->string('director', 100)->nullable();
            $table->string('country', 20)->nullable();
            $table->date('release_date');
            $table->integer('length')->nullable();
            $table->string('subtitle', 50)->nullable();
            $table->string('genres', 50)->nullable();
            $table->string('rating', 5)->nullable();
            $table->string('url', 200);
            $table->smallInteger('status');
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
        Schema::dropIfExists('movies');
    }
}
