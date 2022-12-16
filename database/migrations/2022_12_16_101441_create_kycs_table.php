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
            $table->biginteger('uid');
            $table->string('email');
            $table->string('fname');
            $table->string('lname');
            $table->string('phone_number_one');
            $table->string('phone_number_two');
            $table->string('id_doc');
            $table->string('id_front_image');
            $table->string('id_back_image');
            $table->string('country');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('acount_number');
            $table->string('citizen_srilanka');
            $table->string('cw_address')->nullable();
            $table->string('status')->default(0);
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
