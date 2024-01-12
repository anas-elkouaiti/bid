<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immagine', function (Blueprint $table) {
            $table->id();
            $table->integer('prodotto_id')->unsigned();
            $table->foreign('prodotto_id')->references('id')->on('prodotto')->onDelete('cascade');
            $table->string('percorso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('immagine');
    }
};
