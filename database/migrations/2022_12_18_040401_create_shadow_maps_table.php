<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShadowMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shadow_maps', function (Blueprint $table) {
            $table->id();
            $table->biginteger('y');
            $table->biginteger('x');
            $table->biginteger('user_id');
            $table->integer('status');
            $table->biginteger('parent_node');
            $table->integer('reference_node_side');
            $table->biginteger('x_max');
            $table->biginteger('x_count');  
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
        Schema::dropIfExists('shadow_maps');
    }
}
