<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;

class GameConfig extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'game_configs';
    protected $fillable = [
        'event_id',
        'referee_id',
        'category',
        'duration',
        'players_per_team',
        'points',
        'config',
    ];
    protected $auditInclude = [
        'event_id',
        'referee_id',
        'category',
        'duration',
        'players_per_team',
        'points',
        'config',
    ];

    protected $casts = [
        'duration'        => 'integer',
        'players_per_team' => 'integer',
        'points'          => 'integer',
        'config'          => 'array',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
        'deleted_at'      => 'datetime',
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
}
