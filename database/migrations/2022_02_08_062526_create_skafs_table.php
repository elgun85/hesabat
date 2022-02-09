<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skafs', function (Blueprint $table) {
            $table->id();
            $table->integer('telefon');
            $table->integer('pay_skaf');
            $table->integer('ats');
            $table->integer('skaf');
            $table->integer('mz');
            $table->integer('cut1');
            $table->integer('kabel');
            $table->integer('cut2');
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
        Schema::dropIfExists('skafs');
    }
}
