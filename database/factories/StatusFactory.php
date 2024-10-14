<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bc_form_id' => $this->faker->numberBetween(6, 10), 
            'created_by' => 1, 
            'updated_by' => 1,
            'name' => $this->faker->word(), 
            'description' => $this->faker->text(), 
            'created_at' => $this->faker->dateTime(), 
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
