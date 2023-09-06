<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Jobs\UpdateMicorosoftTodoJob;
use App\Models\Todo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UpdateTodo
{
    public function __invoke($rootValue, array $args, GraphQLContext $context): Todo
    {
        $todo = Todo::find($args['id']);
        $todo->update($args);

        //Dispatch sync job
        $id = 123; //Harcoded foreign ID for now
        dispatch(new UpdateMicorosoftTodoJob($id, $todo));

        return $todo;
    }
}
