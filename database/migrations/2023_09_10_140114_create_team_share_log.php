<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamShareLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_share_log', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('oder_id');
            $table->string('srs_number');
            $table->bigInteger('team_share_value');
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
        Schema::dropIfExists('team_share_log');
    }
}
