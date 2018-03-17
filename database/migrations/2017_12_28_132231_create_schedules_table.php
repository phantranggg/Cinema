<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id');
            $table->integer('theater_id');
            $table->string('type', 5);
            $table->time('show_time');
            $table->date('show_date');
            $table->float('price');
            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('theater_id')->references('id')->on('theaters');
            $table->smallInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('schedules');
    }

}
