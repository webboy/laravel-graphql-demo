<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\GraphQL\GraphQLQuery;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class TodosQuery extends GraphQLQuery
{
    /**
     * @param null $rootValue
     * @param array{} $args
     * @param GraphQLContext $context
     * @return LengthAwarePaginator
     */
    public function __invoke($rootValue, array $args, GraphQLContext $context): LengthAwarePaginator
    {
        /**
         * @var User $user
         */
        $user = $context->user();
        return Todo::where('user_id', $user->id)
            ->byStatus($args['status'] ?? null)
            ->paginate($args['first'] ?? $this->default_per_page);
    }
}
