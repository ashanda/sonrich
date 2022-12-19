<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectCommissionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_commission_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->double('amount', 8, 2);
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
        Schema::dropIfExists('direct_commission_logs');
    }
}
