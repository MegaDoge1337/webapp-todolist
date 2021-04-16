<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TodoList
 *
 * @property int $id
 * @property int $user_id
 * @property string $todo_text
 * @property int $is_complete
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TodoListFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList query()
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereIsComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereTodoText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TodoList whereUserId($value)
 * @mixin \Eloquent
 */
class TodoList extends Model
{
    use HasFactory;

    protected $table = "todolists";

    protected $fillable = [
        'user_id',
        'todo_text',
        'is_complete'
    ];
}
