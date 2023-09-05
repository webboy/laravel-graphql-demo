<?php

namespace Tests\Feature\GraphQL;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\GraphQLTestCase;
use Tests\TestCase;

class TodoQueryTest extends GraphQLTestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testFetchSingleTodoForAuthenticatedUser()
    {

        // Create a todo for the user
        $todo = Todo::factory()->create(['user_id' => $this->user->id]);

        // Define GraphQL query
        $query = "
        {
            todo(id: {$todo->id}) {
                id
                title
            }
        }";

        // Execute GraphQL query
        $response = $this->graphQL($query);

        // Assert the response
        $response->assertJson([
            'data' => [
                'todo' => [
                    'id' => strval($todo->id),  // GraphQL ID type is usually a string
                    'title' => $todo->title,
                ],
            ],
        ]);
    }
}
