<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Jobs\CreateMicorosoftTodoJob;
use App\Models\Todo;
use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class CreateTodo
{
    public function __invoke($rootValue, array $args, GraphQLContext $context): Todo
    {
        /**
         * @var User $user
         */
        $user = $context->user();

        $todo = new Todo($args);
        $todo->user_id = $user->id;
        $todo->save();

        //Dispatch sync job
        dispatch(new CreateMicorosoftTodoJob($todo));

        return $todo;
    }
}
