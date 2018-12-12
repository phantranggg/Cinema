<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->date('date_of_birth')->nullable();
            $table->string('account_type', 10)->nullable();
            $table->string('email', 30)->unique();
            $table->string('phone', 15)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('role', 10)->nullable();
            $table->string('password');
            $table->smallInteger('status');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
