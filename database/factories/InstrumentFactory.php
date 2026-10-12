<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Acoustic Guitar', 'Digital Piano', 'Violin',
                'Drum Set', 'Flute'
            ]),
            'category' => fake()->randomElement([
                'Strings', 'Keyboard', 'Percussion', 'Wind', 'Brass', 'Other'
            ]),
            'condition' => fake()->randomElement([
                'Excellent', 'Good', 'Fair', 'Needs Repair'
            ]),
            'quantity' => fake()->numberBetween(1, 10),
            'availability' => fake()->randomElement([
                'Available', 'Unavailable', 'Maintenance'
            ]),
            'description' => fake()->sentence(),
        ];
    }
}
