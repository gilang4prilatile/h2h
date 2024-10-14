<?php

namespace Database\Factories;

use App\Models\BcForm;
use App\Models\Status;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InboundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bc_form_id' => BcForm::factory()->create()->id,
            'status_id' => Status::factory()->create()->id, 
            'created_by' => User::factory()->create()->id,
            'updated_by' => User::factory()->create()->id,
            'request_number' => $this->faker->numerify("number-##########"), 
            'details' => ["register_number" => $this->faker->numerify("register_number-##########")],
            'created_at' => $this->faker->dateTime(), 
            'updated_at' => $this->faker->dateTime()
        ];
    }
}
