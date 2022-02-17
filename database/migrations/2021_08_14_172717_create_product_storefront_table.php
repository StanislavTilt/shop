<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStorefrontTable extends Migration
{
    public function up()
    {
        Schema::create('product_storefront', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_id')->constrained();
            $table->foreignId('storefront_id')->constrained();
            $table->dateTime('expired_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_storefront');
    }
}
