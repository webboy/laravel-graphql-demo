<?php

namespace App\Services\TodoService\Microsoft;

use App\Models\Todo;
use App\Services\TodoService\Microsoft\Models\MicrosoftTodoDTO;

class MicrosoftTodoMapper
{
    /**
     * Map a MicrosoftTodoDTO to a local Todo model.
     */
    public function toLocalModel(MicrosoftTodoDTO $dto): Todo
    {
        $todo = new Todo();
        $todo->id = $dto->id;
        $todo->title = $dto->title;
        // ... map other fields

        return $todo;
    }

    /**
     * Map a local Todo model to a MicrosoftTodoDTO.
     */
    public function toForeignModel(Todo $todo): MicrosoftTodoDTO
    {
        return new MicrosoftTodoDTO([
            'id' => $todo->id,
            'title' => $todo->title,
            // ... other fields
        ]);
    }
}
