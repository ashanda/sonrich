<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWalletLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_wallet_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->double('amount', 8, 2);
            $table->integer('oder_id')->nullable();
            $table->integer('reference_oder_id')->nullable();
            $table->string('trx_direction');
            $table->string('description');
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
        Schema::dropIfExists('product_wallet_logs');
    }
}
