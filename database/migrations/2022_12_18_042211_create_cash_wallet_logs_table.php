<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashWalletLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_wallet_logs', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id');
            $table->double('amount', 8, 2);
            $table->biginteger('oder_id');
            $table->biginteger('reference_oder_id');
            $table->biginteger('trx_direction');
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
        Schema::dropIfExists('cash_wallet_logs');
    }
}
