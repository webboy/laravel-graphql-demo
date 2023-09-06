<?php

namespace Tests\Feature\GraphQL;

use App\Enums\TodoStatus;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GraphQLTestCase;

class TodosQueryTest extends GraphQLTestCase
{
    use RefreshDatabase;

    public function testFetchTodosForAuthenticatedUser()
    {
        Todo::factory()->count(10)->create(['user_id' => $this->user->id]);

        // Define GraphQL query
        $query = '
        {
            todos(first: 3) {
                data {
                    id
                    title
                }
            }
        }';

        $response = $this->graphQL($query);

        // Assert the response
        $response->assertJsonStructure([
            'data' => [
                'todos' => [
                    'data' => [
                        '*' => [
                            'id',
                            'title',
                        ],
                    ],
                ],
            ],
        ]);

        $response->assertJsonCount(3, 'data.todos.data');
    }

    public function testFetchTodosForAuthenticatedUserFilterByStatus()
    {
        Todo::factory()->count(5)->create(['user_id' => $this->user->id, 'status' => TodoStatus::ABORTED->value]);
        Todo::factory()->count(7)->create(['user_id' => $this->user->id, 'status' => TodoStatus::COMPLETED->value]);

        $query = '
        {
            todos(first: 10, status: ABORTED) {
                data {
                    id
                    title
                }
            }
        }';

        $response = $this->graphQL($query);

        $response->assertJsonCount(5, 'data.todos.data');

        $query = '
        {
            todos(first: 10, status: COMPLETED) {
                data {
                    id
                    title
                }
            }
        }';

        $response = $this->graphQL($query);

        $response->assertJsonCount(7, 'data.todos.data');
    }

    public function testPagination()
    {
        Todo::factory()->count(50)->create(['user_id' => $this->user->id]);

        $query = '
        {
            todos(first: 13) {
                data {
                    id
                    title
                }
            }
        }';

        $response = $this->graphQL($query);

        $response->assertJsonCount(13, 'data.todos.data');

        $query = '
        {
            todos(first: 25) {
                data {
                    id
                    title
                }
            }
        }';

        $response = $this->graphQL($query);

        $response->assertJsonCount(25, 'data.todos.data');

        $query = '
        {
            todos(first: 15, page: 3) {
                data {
                    id
                    title
                }
            }
        }';

        $response = $this->graphQL($query);

        $response->assertJsonCount(15, 'data.todos.data');

    }
}
