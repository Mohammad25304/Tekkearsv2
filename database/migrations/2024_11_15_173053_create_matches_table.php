<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained('competitions')->onDelete('cascade');
            $table->string('home_team');
            $table->string('away_team');
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->date('match_date');
            $table->string('status')->default('scheduled'); // e.g., scheduled, finished
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
