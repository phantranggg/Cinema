<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id');
            $table->integer('user_id');
            $table->string('chair_num', 3);
            $table->foreign('schedule_id')->references('id')->on('schedules');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['schedule_id', 'chair_num']);
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
        Schema::dropIfExists('tickets');
    }
}
