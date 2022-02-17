<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_main')->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
