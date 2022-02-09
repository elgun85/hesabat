<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bank2021Miqration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_2021', function (Blueprint $table) {
            $table->id();
            $table->integer('notel');
            $table->integer('kodqurum');
            $table->integer('kodxidmet');
            $table->integer('summa');
            $table->integer('ay');
            $table->integer('il');
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
        Schema::dropIfExists('bank_2021');
    }
}
