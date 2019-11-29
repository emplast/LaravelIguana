<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('autor');
            $table->text('opis');
            $table->integer('id_uzytkownika');
            $table->integer('id_albumu');
            $table->integer('id_zdjecia');
            $table->integer('wlasciciel');
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
        Schema::dropIfExists('Comments');
    }
}
