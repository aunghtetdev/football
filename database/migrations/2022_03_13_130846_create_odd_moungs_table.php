<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOddMoungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odd_moungs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('match_id');
            $table->bigInteger('over_team_id')->nullable();
            $table->bigInteger('underteam_id')->nullable();
            $table->string('body_value')->nullable();
            $table->string('goal_total_value')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('odd_moungs');
    }
}
