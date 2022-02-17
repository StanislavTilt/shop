<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('cover')->nullable();
            $table->unsignedInteger('order');
            $table->boolean('is_active')->default(false);
            $table->foreignId('parent_id')->nullable()->constrained('categories');
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
