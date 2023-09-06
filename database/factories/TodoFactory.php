<?php

namespace Database\Factories;

use App\Enums\TodoStatus;
use App\Models\Todo;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'todo_list_id' => TodoList::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => TodoStatus::PENDING->value,
        ];
    }
}
