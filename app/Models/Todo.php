<?php

namespace App\Models;

use Database\Factories\TodoFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Todo
 *
 * @property mixed $user_id
 * @property int $id
 * @property int|null $todo_list_id
 * @property string $title
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read TodoList|null $todoList
 * @property-read User $user
 *
 * @method static TodoFactory factory($count = null, $state = [])
 * @method static Builder|Todo newModelQuery()
 * @method static Builder|Todo newQuery()
 * @method static Builder|Todo query()
 * @method static Builder|Todo whereCreatedAt($value)
 * @method static Builder|Todo whereId($value)
 * @method static Builder|Todo whereStatus($value)
 * @method static Builder|Todo whereTitle($value)
 * @method static Builder|Todo whereTodoListId($value)
 * @method static Builder|Todo whereUpdatedAt($value)
 * @method static Builder|Todo whereUserId($value)
 * @method static Builder|Todo byStatus($status = null)
 *
 * @property string|null $description
 * @property string|null $scheduled_at
 *
 * @method static Builder|Todo byTodoListId(?int $todo_list_id = null)
 * @method static Builder|Todo whereDescription($value)
 * @method static Builder|Todo whereScheduledAt($value)
 *
 * @mixin Eloquent
 */
class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'description',
        'scheduled_at',
        'todo_list_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function todoList(): BelongsTo
    {
        return $this->belongsTo(TodoList::class);
    }

    public function scopeByStatus(Builder $query, $status = null): Builder
    {
        if (! empty($status)) {
            $query->where('status', $status);
        }

        return $query;
    }

    public function scopeByTodoListId(Builder $query, int $todo_list_id = null): Builder
    {
        if (! empty($todo_list_id)) {
            $query->where('todo_list_id', $todo_list_id);
        }

        return $query;
    }
}
