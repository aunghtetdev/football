<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiveOddsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_odds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('odd_id');
            $table->string('body_value')->nullable();
            $table->string('goal_total_value')->nullable();
            $table->boolean('live')->default(0);
            $table->timestamp('datetime')->nullable();
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
        Schema::dropIfExists('live_odds');
    }
}
