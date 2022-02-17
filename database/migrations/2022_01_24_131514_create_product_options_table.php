<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('product_id');
            $table->string('size');
            $table->integer('quantity');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
    }
}
