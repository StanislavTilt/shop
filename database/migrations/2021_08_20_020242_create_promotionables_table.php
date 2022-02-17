<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionablesTable extends Migration
{
    public function up()
    {
        Schema::create('promotionables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('promotion_id')->constrained();
            $table->unsignedBigInteger('promotionable_id');
            $table->string('promotionable_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotionables');
    }
}
