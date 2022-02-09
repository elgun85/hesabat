<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGhAetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gh_aets', function (Blueprint $table) {
            $table->id();

            $table->integer('notel')->nullable();
            $table->integer('kodqurum')->nullable();
            $table->integer('abonent')->nullable();
            $table->integer('kodtarif')->nullable();
            $table->decimal('summa')->nullable();
            $table->integer('saytel')->nullable();
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
        Schema::dropIfExists('gh_aets');
    }
}
