<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinaryCommissionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binary_commission_logs', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('user_id');
            $table->double('amount', 8, 2);
            $table->integer('side');
            $table->integer('oder_id');
            $table->integer('reference_oder_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binary_commission_logs');
    }
}
