<?php
// database/factories/PeopleFactory.php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeopleFactory extends Factory
{
    protected $model = People::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'age' => $this->faker->numberBetween(18, 60),
            'location' => $this->faker->city,
            'class' => $this->faker->word,
        ];
    }
}
