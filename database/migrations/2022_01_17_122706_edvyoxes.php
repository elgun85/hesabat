<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Edvyoxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edvyoxes', function (Blueprint $table) {
            $table->id();
            $table->integer('kodqurum')->nullable();
            $table->string('adqurum')->nullable();
            $table->string('kateqor');
            $table->string('kodmhm')->nullable();
            $table->string('ay');
            $table->string('il');
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
        Schema::dropIfExists('edvyoxes');
    }
}
