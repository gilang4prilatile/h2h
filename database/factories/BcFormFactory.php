<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BcFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by' => User::factory()->create()->id,
            'updated_by' => User::factory()->create()->id,
            'name' => $this->faker->word(), 
            'description' => $this->faker->text(),
            'created_at' => $this->faker->dateTime(), 
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
