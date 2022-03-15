<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moungs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bet_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('odd_moung_id')->nullable();
            $table->unsignedBigInteger('match_id')->nullable();
            $table->unsignedBigInteger('over_team_id')->nullable();
            $table->unsignedBigInteger('under_team_id')->nullable();
            $table->unsignedBigInteger('bet_team_id')->nullable();
            $table->string('bet_total_goal')->nullable()->comment('over or under');
            $table->timestamp('date')->nullable();
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
        Schema::dropIfExists('moungs');
    }
}
