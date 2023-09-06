<?php

namespace App\Services\TodoService\Microsoft;

use App\Models\Todo;
use App\Services\TodoService\Microsoft\Models\MicrosoftTodoDTO;
use App\Services\TodoService\TodoServiceInterface;

class MicrosoftTodoService implements TodoServiceInterface
{
    protected MicrosoftTodoClient $client;

    protected MicrosoftTodoMapper $mapper;

    public function __construct(MicrosoftTodoClient $client, MicrosoftTodoMapper $mapper)
    {
        $this->client = $client;
        $this->mapper = $mapper;
    }

    /**
     * Fetch all todos from Microsoft Todo API and map them to local models.
     */
    public function fetchTodos(): array
    {
        $apiData = $this->client->getTodos();
        $dtos = array_map(function ($item) {
            return new MicrosoftTodoDTO($item);
        }, $apiData);

        return array_map([$this->mapper, 'toLocalModel'], $dtos);
    }

    /**
     * Create a new todo in Microsoft Todo API.
     */
    public function createTodo(Todo $todo): Todo
    {

        $apiData = $this->mapper
            ->toForeignModel($todo)
            ->toArray();

        $createdData = $this->client
            ->createTodo($apiData);

        return $this->mapper->toLocalModel(new MicrosoftTodoDTO($createdData));
    }

    // ... other methods as per TodoServiceInterface
    public function updateTodo($id, Todo $todo): Todo
    {

        $apiData = $this->mapper->toForeignModel($todo)->toArray();
        $updatedData = $this->client->updateTodo($id, $apiData);

        return $this->mapper->toLocalModel(new MicrosoftTodoDTO($updatedData));
    }
}
