<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Flkart8Miqration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flkart8', function (Blueprint $table) {
            $table->id();
            $table->integer('notel')->nullable();
            $table->integer('kodqurum')->nullable();
            $table->integer('kodtarif')->nullable();
            $table->integer('abonent')->nullable();
            $table->integer('abonent2')->nullable();
            $table->decimal('summa')->nullable();
            $table->integer('ay')->nullable();
            $table->integer('il')->nullable();
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
        Schema::dropIfExists('flkart8');
    }
}
