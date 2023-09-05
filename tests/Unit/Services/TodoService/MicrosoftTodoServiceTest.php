<?php

namespace Tests\Unit\Services\TodoService;

use App\Models\Todo;
use App\Services\TodoService\Microsoft\MicrosoftTodoClient;
use App\Services\TodoService\Microsoft\MicrosoftTodoMapper;
use App\Services\TodoService\Microsoft\MicrosoftTodoService;
use App\Services\TodoService\Microsoft\Models\MicrosoftTodoDTO;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MicrosoftTodoServiceTest extends TestCase
{
    protected MicrosoftTodoClient|MockObject $clientMock;

    protected MicrosoftTodoMapper|MockObject $mapperMock;

    protected MicrosoftTodoService $service;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->clientMock = $this->createMock(MicrosoftTodoClient::class);
        $this->mapperMock = $this->createMock(MicrosoftTodoMapper::class);

        $this->service = new MicrosoftTodoService($this->clientMock, $this->mapperMock);
    }

    public function testFetchTodos()
    {
        $this->clientMock->expects($this->once())
            ->method('getTodos')
            ->willReturn([
                ['id' => 1, 'title' => 'Test Todo 1'],
                ['id' => 2, 'title' => 'Test Todo 2'],
            ]);

        $this->mapperMock->expects($this->exactly(2))
            ->method('toLocalModel')
            ->willReturn(new Todo());

        $result = $this->service->fetchTodos();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    public function testCreateTodo()
    {
        $todo = new Todo();
        $todo->title = 'Test Todo';

        $this->mapperMock->expects($this->once())
            ->method('toForeignModel')
            ->willReturn(new MicrosoftTodoDTO(['title' => 'Test Todo']));

        $this->clientMock->expects($this->once())
            ->method('createTodo')
            ->willReturn(['id' => 1, 'title' => 'Test Todo']);

        $result = $this->service->createTodo($todo);

        $this->assertInstanceOf(Todo::class, $result);
    }

    public function testUpdateTodo()
    {
        $todo = new Todo();
        $todo->id = 1;
        $todo->title = 'Updated Todo';

        $this->mapperMock->expects($this->once())
            ->method('toForeignModel')
            ->willReturn(new MicrosoftTodoDTO(['id' => 1, 'title' => 'Updated Todo']));

        $this->clientMock->expects($this->once())
            ->method('updateTodo')
            ->willReturn(['id' => 1, 'title' => 'Updated Todo']);

        $result = $this->service->updateTodo(1, $todo);

        $this->assertInstanceOf(Todo::class, $result);
    }
}
