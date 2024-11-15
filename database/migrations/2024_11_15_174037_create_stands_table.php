<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandsTable extends Migration
{
    public function up()
    {
        Schema::create('stands', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competition_id'); // Competition ID
            $table->string('team_name');
            $table->integer('position')->nullable();
            $table->integer('played_games')->nullable();
            $table->integer('won')->nullable();
            $table->integer('draw')->nullable();
            $table->integer('lost')->nullable();
            $table->integer('points')->nullable();
            $table->integer('goals_for')->nullable();
            $table->integer('goals_against')->nullable();
            $table->integer('goal_difference')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stands');
    }
}
