<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\User;
use App\Models\Event;
use App\Models\Team;
use App\Models\Result;

class Game extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'games';
    protected $fillable = [
        'number',
        'duration',
        'start_time',
        'end_time',
        'status',
        'event_id',
        'referee_id',
    ];

    protected $auditInclude = [
        'number',
        'duration',
        'start_time',
        'end_time',
        'status',
        'event_id',
        'referee_id',
    ];

    protected $casts = [
        'number'     => 'integer',
        'duration'   => 'integer',
        'start_time' => 'time',
        'end_time'   => 'time',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function referee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referee_id');
    }

    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
