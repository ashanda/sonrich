<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kycs', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id');
            $table->string('mobile_number1');
            $table->string('mobile_number2');
            $table->string('id_docs_type');
            $table->string('id_doc_front');
            $table->string('id_doc_back');
            $table->string('country');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('bank_acount_number');
            $table->string('citizen');
            $table->string('address');
            $table->string('crypto_wallet')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('kycs');
    }
}
