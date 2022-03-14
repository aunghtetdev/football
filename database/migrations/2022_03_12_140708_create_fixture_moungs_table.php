<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixtureMoungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixture_moungs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('home_team_id');
            $table->bigInteger('away_team_id');
            $table->bigInteger('home_team_goal')->default(0);
            $table->bigInteger('away_team_goal')->default(0);
            $table->integer('overteam_amount')->default(0);
            $table->integer('underteam_amount')->default(0);
            $table->integer('over_goal_amount')->default(0);
            $table->integer('under_goal_amount')->default(0);
            $table->dateTime('date');
            $table->boolean('finished')->default(0);
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
        Schema::dropIfExists('fixture_moungs');
    }
}
