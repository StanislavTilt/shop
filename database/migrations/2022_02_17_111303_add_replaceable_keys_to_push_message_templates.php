<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReplaceableKeysToPushMessageTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('push_message_templates', function (Blueprint $table) {
            $table->json('replaceable_keys')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('push_message_templates', function (Blueprint $table) {
            $table->dropColumn('replaceable_keys');
        });
    }
}
