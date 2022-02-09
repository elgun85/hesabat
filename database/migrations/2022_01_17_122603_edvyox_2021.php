<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Edvyox2021 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edvyox_2021', function (Blueprint $table) {
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
        Schema::dropIfExists('edvyox_2021');
    }
}
