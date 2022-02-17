<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReportChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_report_changes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_report_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('new_status')->nullable();
            $table->string('new_comment')->nullable();
            $table->timestamps();

            $table->foreign('order_report_id')
                ->references('id')
                ->on('order_reports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('admin_id')
                ->references('id')
                ->on('admins')
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
        Schema::dropIfExists('order_report_changes');
    }
}
