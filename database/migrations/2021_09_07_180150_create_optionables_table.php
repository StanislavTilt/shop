<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionablesTable extends Migration
{
    public function up()
    {
        Schema::create('optionables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('attribute_id')->constrained();
            $table->foreignId('attribute_option_id')->constrained();
            $table->unsignedBigInteger('optionable_id');
            $table->string('optionable_type');

            $table->unsignedInteger('quantity')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('optionables');
    }
}
