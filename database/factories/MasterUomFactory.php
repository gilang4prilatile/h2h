<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MasterUomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word(), 
            'name' => $this->faker->word(),
            'created_at' => $this->faker->dateTime(), 
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
