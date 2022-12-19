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
            $table->integer('id');
            $table->integer('y');
            $table->integer('x');
            $table->integer('user_id');
            $table->integer('status');
            $table->integer('parent_node');
            $table->integer('reference_node_side');
            $table->integer('x_max');
            $table->integer('x_count');  
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
