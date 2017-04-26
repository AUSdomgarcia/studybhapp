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
            $table->string('name');
            $table->tinyInteger('role_id')->default(1);
            $table->softDeletes();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->tinyInteger('locked')->default(0);
            $table->tinyInteger('login_attempts')->default(0);
            $table->string('end_lock_time')->nullable();
            $table->string('locked_time_started')->nullable();
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
