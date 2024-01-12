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
        Schema::create('prodotto', function (Blueprint $table) {
            $table->id();
            $table->integer('venditore_id')->unsigned();
            $table->foreign('venditore_id')->references('id')->on('utente')->onDelete('cascade');
            $table->string('titolo');
            $table->longText('descrizione');
            $table->string('location');
            $table->float('base_asta');
            $table->timestamp('data_caricamento');
            $table->timestamp('data_scadenza');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodotto');
    }
};
