<?php

namespace App\Services\TodoService\Microsoft\Models;

class MicrosoftTodoDTO
{
    public ?int $id;

    public ?string $title;
    // ... other fields

    public function __construct(array $attributes = [])
    {
        $this->id = $attributes['id'] ?? null;
        $this->title = $attributes['title'] ?? null;
        // ... initialize other fields
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            //implement other propertuies
        ];
    }
}
