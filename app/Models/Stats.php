<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;

class Stats extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'stats';
    protected $fillable = [
        "gameId",
        "stats",
    ];
    protected $auditInclude = [
        "gameId",
        "stats",
    ];

    protected $casts = [
        'stats'      => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
