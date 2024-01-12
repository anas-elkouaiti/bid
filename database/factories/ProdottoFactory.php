<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Utente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prodotto>
 */
class ProdottoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $utente = Utente::all()->random(1)->first();
        
        return [
            'venditore_id' => $utente->id,
            'titolo' => $this->faker->sentence(rand(2, 6)),
            'descrizione' => $this->faker->text(),
            'location' => $this->faker->country(),
            'base_asta' => $this->faker->randomFloat(2, 0, 100),
            'data_caricamento' => $this->faker->dateTimeBetween('-1 week', '-2 days'),
            'data_scadenza' => $this->faker->dateTimeBetween('-1 day', '+2 weeks')
        ];
    }
}
