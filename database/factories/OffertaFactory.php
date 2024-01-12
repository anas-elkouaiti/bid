<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Utente;
use App\Models\Prodotto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prodotto>
 */
class OffertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $valori_stato = ['aggiudicato', 'non_aggiudicato', 'piu_alta', 'superata'];
        $utente = Utente::all()->random(1)->first();
        $prodotto = Prodotto::all()->random(1)->first();

        return [
            'utente_id' => $utente->id,
            'prodotto_id' => $prodotto->id,
            'prezzo' => $this->faker->randomFloat(2, 0, 5000),
            'stato' => $this->faker->randomElement($valori_stato),
            'data_esecuzione' => $this->faker->dateTimeBetween('-2 days', '+2 days')
        ];
    }
}
