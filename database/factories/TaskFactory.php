<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $position = Task::count() + 1;
        return [
            'name' => $this->faker->sentence,
            'position' => $position,
            'is_completed' => $this->faker->boolean,
        ];
    }
}
