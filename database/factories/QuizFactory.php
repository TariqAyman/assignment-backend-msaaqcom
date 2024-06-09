<?php

namespace Database\Factories;

use App\Enums\QuizType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = now();
        $hasTime = fake()->boolean();

        return [
            'title' => fake()->paragraph(1),
            'slug' => fake()->slug(),
            'type' => fake()->randomElement(QuizType::toValidationRequest()),
            'start_date' => $hasTime ? $now->copy()->addMinutes(5) : null,
            'end_date' => $hasTime ? $now->copy()->addMinutes(10) : null,
            'description' => fake()->text(),
        ];
    }
}
