<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('payment_type');
            $table->integer('delivery_type');
            $table->string('delivery_address')->nullable()->default(null);
            $table->integer('status')->default(0);
            $table->foreignId('delivery_department_id')->nullable()->default(null)->constrained();
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
