<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('attribute_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('value')->nullable();
            $table->string('key')->unique();
            $table->foreignId('attribute_id')->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attribute_options');
    }
}
