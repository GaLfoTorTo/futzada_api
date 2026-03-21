<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;
use App\Models\Game;
use App\Models\Team;

class Result extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'results';
    protected $fillable = [
        'game_id',
        'team_a_id',
        'team_b_id',
        'team_a_score',
        'team_b_score',
        'duration',
    ];
    
    protected $auditInclude = [
        'game_id',
        'team_a_id',
        'team_b_id',
        'team_a_score',
        'team_b_score',
        'duration',
    ];

    protected $casts = [
        'team_a_score' => 'integer',
        'team_b_score' => 'integer',
        'duration'     => 'integer',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function teamA(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_a_id');
    }

    public function teamB(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_b_id');
    }
}
