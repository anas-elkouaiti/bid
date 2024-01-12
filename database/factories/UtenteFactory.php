<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utente>
 */
class UtenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => $this->faker->email(),
            'username' => $this->faker->userName(),
            'password' => md5("ciao"),
            'paese' => $this->faker->country(),
            'indirizzo' => $this->faker->address(),
            'nome' => $this->faker->firstName(),
            'cognome' => $this->faker->lastName(),
            'img_profilo' => "/images/profile_pictures/pro-pic.png",
            'bilancio' => $this->faker->randomFloat(2, 0, 10000)
        ];
    }
}
