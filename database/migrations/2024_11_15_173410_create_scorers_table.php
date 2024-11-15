<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScorersTable extends Migration
{
    public function up()
    {
        Schema::create('scorers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('team')->nullable();
            $table->integer('goals')->default(0);
            $table->string('position')->nullable();
            $table->integer('assists')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('nationality')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scorers');
    }
}
