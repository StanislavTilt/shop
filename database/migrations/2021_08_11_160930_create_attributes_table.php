<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type');
            $table->string('key')->unique();
            $table->integer('sort_order');
            $table->boolean('is_required')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
