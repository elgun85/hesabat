<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGelave2109sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gelave_2109s', function (Blueprint $table) {
            $table->id();
            $table->integer('notel')->nullable();
            $table->integer('kodtarif')->nullable();
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
        Schema::dropIfExists('gelave_2109s');
    }
}
