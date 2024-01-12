<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Utente;
use App\Models\Prodotto;
use App\Models\Categoria;
use App\Models\Offerta;
use App\Models\Immagine;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Utente::factory(10)->create();
        Categoria::factory(10)->create();
        Prodotto::factory(50)->create();
        Offerta::factory(75)->create();
        
        $categorie = Categoria::all();

        Prodotto::all()->each(function($prodotto) use ($categorie){
            $prodotto->categorie()->attach(
                $categorie->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        Prodotto::all()->each(function($prodotto){
            Immagine::create([
                'prodotto_id' => $prodotto->id,
                'percorso' => '/images/product_pictures/prod1.png'
            ]);
        });
    }
}
