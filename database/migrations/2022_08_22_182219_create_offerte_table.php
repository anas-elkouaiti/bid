<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *string
     * @return void
     */
    public function up()
    {
        Schema::create('offerta', function (Blueprint $table) {
            $table->id();
            $table->integer('utente_id')->unsigned();
            $table->foreign('utente_id')->references('id')->on('utente')->onDelete('cascade');
            $table->integer('prodotto_id')->unsigned();
            $table->foreign('prodotto_id')->references('id')->on('prodotto')->onDelete('cascade');
            $table->float('prezzo');
            $table->enum('stato', ['aggiudicato', 'non_aggiudicato', 'piu_alta', 'superata']);
            $table->timestamp('data_esecuzione');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offerta');
    }
};
