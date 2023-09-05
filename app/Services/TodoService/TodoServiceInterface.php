<?php

namespace App\Services\TodoService;

use App\Models\Todo;

interface TodoServiceInterface
{
    public function fetchTodos();

    public function createTodo(Todo $todo);

    public function updateTodo($id, Todo $todo);
}
