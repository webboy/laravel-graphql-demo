<?php

namespace App\Services\TodoService\Microsoft;

use Exception;

class MicrosoftTodoClient
{
    /**
     * Fetch all todos from Microsoft Todo API.
     *
     * @return array
     * @throws Exception
     */
    public function getTodos(): array
    {
        // TODO: Replace with actual API call
        // Handle API errors and exceptions here
        return [
            ['id' => 1, 'title' => 'Dummy Todo 1'],
            ['id' => 2, 'title' => 'Dummy Todo 2'],
        ];
    }

    /**
     * Create a new todo in Microsoft Todo API.
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function createTodo(array $data): array
    {
        // TODO: Replace with actual API call
        // Handle API errors and exceptions here
        return ['id' => 3, 'title' => $data['title']];
    }

    /**
     * Update an existing todo in Microsoft Todo API.
     *
     * @param int $id
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function updateTodo(int $id, array $data): array
    {
        // TODO: Replace with actual API call
        // Handle API errors and exceptions here
        return ['id' => $id, 'title' => $data['title']];
    }

    // ... other methods for API interaction
    // TODO: Add methods for API authentication if needed
}
