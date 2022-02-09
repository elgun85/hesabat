<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMhmLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mhm_logins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id');
            $table->unsignedBigInteger('vez_id')->index();
            $table->string('login')->unique();
            $table->string('name');
            $table->string('qeyd')->nullable();
//            $table->foreign('vez_id')->references('id')->on('vezives')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('mhm_login_categories')->onDelete('cascade');
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
        Schema::dropIfExists('mhm_logins');
    }
}
