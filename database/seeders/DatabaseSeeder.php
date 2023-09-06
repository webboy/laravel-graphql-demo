<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Todo;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users
        $users = User::factory(10)->create();

        // For each user, create 3 todos and 2 todo lists
        foreach ($users as $user) {

            $lists = TodoList::factory(2)->create(['user_id' => $user->id]);
            foreach ($lists as $list) {
                Todo::factory(3)->create(['user_id' => $user->id, 'todo_list_id' => $list->id]);
            }

        }
    }
}
