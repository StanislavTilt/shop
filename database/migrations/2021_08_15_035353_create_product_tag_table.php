<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagTable extends Migration
{
    public function up()
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->nullable()->constrained();
            $table->foreignId('tag_id')->nullable()->constrained();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_tag');
    }
}
