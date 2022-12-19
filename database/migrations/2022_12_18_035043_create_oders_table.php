<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oders', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('oder_id');
            $table->integer('user_id');
            $table->integer('sponsor_id');
            $table->integer('product_id');
            $table->integer('price');
            $table->string('payment_method');
            $table->integer('wallet_pay_amount');
            $table->integer('cash_pay_amount');
            $table->integer('status');
            $table->integer('max_value');
            $table->integer('total_package_earnings');
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
        Schema::dropIfExists('oders');
    }
}
