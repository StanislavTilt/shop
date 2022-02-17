<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('nickname')->nullable()->unique();
            $table->string('avatar')->nullable();
            $table->string('phone')->unique();
            $table->unsignedInteger('phone_verification_code')->nullable();
            $table->dateTime('phone_verification_code_expire')->nullable();
            $table->dateTime('phone_verified_at')->nullable();
            $table->string('email')->nullable()->unique();
            $table->boolean('has_subscription')->nullable()->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('status');
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
