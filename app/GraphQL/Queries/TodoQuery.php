<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\GraphQLQuery;
use App\Models\Todo;
use App\Models\User;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class TodoQuery extends GraphQLQuery
{
    /**
     * @param  array{}  $args
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context): ?Todo
    {
        /**
         * @var User $user
         */
        $user = $context->user();

        return Todo::where('user_id', $user->id)
            ->where('id', $args['id'])
            ->first();
    }
}
