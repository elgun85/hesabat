<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLstarif2109sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lstarif_2109s', function (Blueprint $table) {
            $table->id();
            $table->integer('kodtarif')->nullable();
            $table->string('adtarif')->nullable();
            $table->integer('kodish')->nullable();
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
        Schema::dropIfExists('lstarif_2109s');
    }
}
