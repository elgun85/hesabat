<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGelirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gelirs', function (Blueprint $table) {
            $table->id();

            $table->string('tarif')->nullable();
            $table->string('is_kod')->nullable();
            $table->integer('say')->nullable();
            $table->integer('mebleg')->nullable();
            $table->string('kat')->nullable();
            $table->string('ay')->nullable();
            $table->integer('il')->nullable();
            $table->string('tarif_kat')->nullable();
            $table->string('xidmet_kat')->nullable();
            $table->string('tax')->nullable();
            $table->integer('edv-siz_mebleg')->nullable();
            $table->string('qeyd')->nullable();
            $table->string('qeyd1')->nullable();

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
        Schema::dropIfExists('gelirs');
    }
}
