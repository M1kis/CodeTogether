<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'level' => $this->faker->randomElement(['Básico','Intermedio','Avanzado']),
            'lessons' => $this->faker->numberBetween(10,150),
            'progress' => $this->faker->numberBetween(0,100),
            'cover' => $this->faker->imageUrl(640,360,'education', true),
        ];
    }
}
