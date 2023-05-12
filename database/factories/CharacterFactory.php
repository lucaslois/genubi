<?php

namespace Database\Factories;

use App\Models\Character;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    protected $model = Character::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'family' => fake()->name(),
            'race' => fake()->name(),
            'age' => fake()->numberBetween(12, 50),
            'description' => fake()->text,
            'nationality' => fake()->text,
            'color' => fake()->text,
            'state_id' => 1,
            'user_id' => User::factory()
            # 'famous_phrase' => fake()->text,
        ];
    }
}
