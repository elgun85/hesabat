<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esas', function (Blueprint $table) {
            $table->id();
            $table->integer('telefon')->unique();
            $table->integer('hesab')->nullable();
            $table->integer('tarif');
            $table->integer('abonent');
            $table->integer('abonent2')->nullable();

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
        Schema::dropIfExists('esas');
    }
}
