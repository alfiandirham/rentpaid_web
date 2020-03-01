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
            $table->string('name',45);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('type',['superuser', 'admin', 'collector']);
            $table->string('nohp',14)->nullable();
            $table->string('ktp',18)->nullable();
            $table->boolean('status')->default(true);
            $table->string('photo')->default('profile.png')->nullable();
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
