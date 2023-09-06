<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TodoList
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\TodoListFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList query()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereUserId($value)
 *
 * @mixin \Eloquent
 */
class TodoList extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
