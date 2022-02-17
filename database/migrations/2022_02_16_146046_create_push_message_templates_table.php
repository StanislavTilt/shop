<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushMessageTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_message_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->string('changeable');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('push_message_types')
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
        Schema::dropIfExists('push_message_templates');
    }
}
