<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorefrontsTable extends Migration
{
    public function up()
    {
        Schema::create('storefronts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover')->nullable();
            $table->string('key')->unique();
            $table->json('parameters')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('storefronts');
    }
}
