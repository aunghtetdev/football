<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bet_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('live_odd_id')->nullable();
            $table->unsignedBigInteger('match_id')->nullable();
            $table->unsignedBigInteger('over_team_id')->nullable();
            $table->unsignedBigInteger('under_team_id')->nullable();
            $table->unsignedBigInteger('bet_team_id')->nullable();
            $table->string('bet_total_goal')->nullable()->comment('over or under');
            $table->integer('bet_amount')->default(0);
            $table->integer('win_amount')->default(0);
            $table->timestamp('date')->nullable();
            $table->string('type')->nullable()->comment('body or moung');
            $table->string('bet_result')->nullable();
            $table->boolean('is_finished')->default(0);
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
        Schema::dropIfExists('bets');
    }
}
