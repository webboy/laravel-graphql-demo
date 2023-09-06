<?php

declare(strict_types=1);

namespace App\GraphQL\Validators;

use App\Enums\TodoStatus;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Nuwave\Lighthouse\Validation\Validator;

final class CreateTodoValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array>
     */
    public function rules(): array
    {
        // Get the ID of the authenticated user
        $userId = auth()->id();

        return [
            'title' => [
                'string',
                'required',
            ],
            'status' => [
                new Enum(TodoStatus::class),
            ],
            'todo_list_id' => [
                'integer',
                Rule::exists('todo_lists', 'id')->where(function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }),
            ],
            'scheduled_at' => [
                'date',
            ],
        ];
    }

    /**
     * Get the validation error messages.
     */
    public function messages(): array
    {
        return [
            'todo_list_id.exists' => 'Provided todo list ID is not valid.',
        ];
    }
}
