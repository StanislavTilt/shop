<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToOrderReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_reports', function (Blueprint $table) {
            $table->string('status')->default('new');
            $table->string('admin_comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_reports', function (Blueprint $table) {
            $table->dropColumn(['status', 'admin_comment']);
        });
    }
}
