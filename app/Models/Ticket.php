<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Ticket
 *
 * @property int $id
 * @property string $type
 * @property string $status
 * @property string $priority
 * @property string $title
 * @property string $description
 * @property string $context
 * @property int $author_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $author
 * @property-read string $priority_color
 * @property-read string $status_color
 * @method static \Database\Factories\TicketFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'status', 'priority', 'title', 'description', 'context', 'author_id'
    ];

    public static function getTypes(): array
    {
        return [
            'type_1' => 'Type 1',
            'type_2' => 'Type 2',
            'type_3' => 'Type 3'
        ];
    }

    public static function getPriorities(): array
    {
        return [
            'priority_1' => 'Priority 1',
            'priority_2' => 'Priority 2',
            'priority_3' => 'Priority 3'
        ];
    }

    public static function getPriorityColors(): array
    {
        return [
            'priority_1' => 'success',
            'priority_2' => 'warning',
            'priority_3' => 'danger',
        ];
    }

    public function getPriorityColorAttribute(): string
    {
        return self::getPriorityColors()[$this->priority] ?? '';
    }

    public static function getStatuses(): array
    {
        return [
            'status_1' => 'Status 1',
            'status_2' => 'Status 2',
            'status_3' => 'Status 3'
        ];
    }

    public static function getStatusColors(): array
    {
        return [
            'status_1' => 'success',
            'status_2' => 'warning',
            'status_3' => 'danger',
        ];
    }

    public function getstatusColorAttribute(): string
    {
        return self::getstatusColors()[$this->status] ?? '';
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
