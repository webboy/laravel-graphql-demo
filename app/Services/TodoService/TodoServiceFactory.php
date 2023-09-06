<?php

namespace App\Services\TodoService;

use App\Services\TodoService\Acme\AcmeTodoService;
use App\Services\TodoService\Microsoft\MicrosoftTodoService;
use Exception;

class TodoServiceFactory
{
    /**
     * Create an instance of a TodoService based on the given service name.
     *
     * @param  string  $serviceName The name of the service ('microsoft', 'acme', etc.)
     * @return TodoServiceInterface The created TodoService instance
     *
     * @throws Exception If an invalid service name is provided
     */
    public static function create(string $serviceName): TodoServiceInterface
    {
        return match ($serviceName) {
            'microsoft' => app(MicrosoftTodoService::class),
            'acme' => app(AcmeTodoService::class),
            default => throw new Exception("Invalid todo service name: $serviceName"),
        };
    }
}
